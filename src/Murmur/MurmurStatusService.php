<?php namespace lrobert\NFOServerStatus\Murmur;

use DOMElement;
use DOMNodeList;
use Symfony\Component\CssSelector\CssSelector;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Gets the status of a mumble server using NFOServers status page
 *
 * @package lrobert\NFOServerStatus\Murmur
 */
class MurmurStatusService
{
    const DEFAULT_STATUS_PAGE_URL = "http://www.nfoservers.com/query/mstat.pl";

    protected $statusPageUrl;

    /**
     * @param string $statusPageUrl The status page URL. Should be safe to leave it as the default
     */
    public function __construct($statusPageUrl = self::DEFAULT_STATUS_PAGE_URL)
    {
        $this->statusPageUrl = $statusPageUrl;
    }

    /**
     * Gets the server status for a given server identifier
     *
     * @param string $serverId You can find the server ID in your control panel
     *
     * @return MurmurStatusModel
     */
    public function getStatus($serverId)
    {
        $murmurStatusModel = new MurmurStatusModel();

        try {
            $statusPageContents = $this->fetchStatusPage($this->buildUrl($serverId));

            $crawler = new Crawler();
            $crawler->addContent($statusPageContents);

            $murmurStatusModel->setOnline(true);
            $murmurStatusModel->setConnectUrl("mumble://" . $crawler->filter('.value-address')->text());
            $murmurStatusModel->setNumberOfClients((int)$crawler->filter('.value-clients .clients-avail')->text());
            $murmurStatusModel->setNumberOfChannels((int)$crawler->filter('.value-channels')->text());
            $murmurStatusModel->setMaxNumberOfClients((int)str_replace('/ ', '', $crawler->filter('.value-clients .clients')->text()));

            $murmurStatusModel->setRootChannel($this->parseChannelList($crawler->filter('.channel-list')->first()));
        } catch (\Exception $e) {
            $murmurStatusModel->setOnline(false);
        }

        return $murmurStatusModel;
    }

    /**
     * Fetches the status page html for parsing
     *
     * @param $statusPageUrl
     *
     * @return string
     */
    protected function fetchStatusPage($statusPageUrl)
    {
        return file_get_contents($statusPageUrl);
    }

    /**
     * Builds the URL string
     *
     * @param string $serverId You can find the server ID in your control panel
     *
     * @return string
     */
    protected function buildUrl($serverId)
    {
        return sprintf("%s?id=%s", $this->statusPageUrl, $serverId);
    }

    /**
     * Parses the channel list into a channel model which contains channels and users
     *
     * @param Crawler|DOMElement[]|DOMNodeList $channelList
     *
     * @return MurmurChannelModel|bool
     */
    private function parseChannelList($channelList)
    {
        $maxDepth = 20;

        /**
         * Internal parsing function to make sure no one can tamper with $depth protection
         *
         * @param Crawler|DOMElement[]|DOMNodeList $channelList
         * @param int                              $depth
         *
         * @return bool|MurmurChannelModel|null
         */
        $parsingFunction = function ($channelList, $depth) use (&$parsingFunction, $maxDepth) {
            /**
             * Fail-safe in case we get a super nested list.
             * Who on earth has more than 20 channels deep.
             */
            if ($depth > $maxDepth) {
                return false;
            }

            $depth++;

            $currentChannel = null;
            $clients        = [];
            $channels       = [];

            foreach ($channelList as $node) {
                if ($node instanceof DOMElement) {
                    if ($node->hasAttribute("class")) {
                        if (stripos($node->getAttribute("class"), "channel-list") !== false && $node->hasChildNodes()) {
                            /**
                             * Channel List: Go one level deeper
                             */
                            $channel = $parsingFunction($node->childNodes, $depth);
                            if ($channel instanceof MurmurChannelModel) {
                                $channels[] = $channel;
                            }
                        } else if (stripos($node->getAttribute("class"), "channel-line") !== false) {
                            /**
                             * Only one channel-line should appear in a channel-list
                             */
                            $crawler = new Crawler($node);

                            $currentChannel = new MurmurChannelModel();
                            $currentChannel->setId($crawler->filter('.channel-id')->text());
                            $currentChannel->setName($crawler->filter('.channel-name')->text());
                        } else if (stripos($node->getAttribute("class"), "client-line") !== false) {
                            /**
                             * Clients are listed after all the sub channel-lists in a given channel-list
                             */
                            $crawler = new Crawler($node);

                            $client = new MurmurClientModel();
                            $client->setId($crawler->filter('.client-id')->text());
                            $client->setName($crawler->filter('.client-name')->text());
                            $client->setTimeOnline($crawler->filter('.client-time')->text());
                            $client->setAdmin($crawler->filter('.client-admin')->text());
                            $clients[] = $client;
                        }
                    }
                }
            }

            /**
             * Add them all together before returning
             */
            if ($currentChannel instanceof MurmurChannelModel) {
                $currentChannel->setClients($clients);
                $currentChannel->setChannels($channels);

                foreach ($clients as $client) {
                    $client->setChannel($currentChannel);
                }

                foreach ($channels as $channel) {
                    $channel->setParentChannel($currentChannel);
                }
            }

            return $currentChannel;
        };

        return $parsingFunction($channelList, 0);
    }
}