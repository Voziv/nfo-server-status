<?php namespace lrobert\NFOServerStatus\Murmur;

class MurmurStatusModel
{
    private $serverId;
    private $online;
    private $connectUrl;
    private $rootChannel;
    private $numberOfClients;
    private $numberOfChannels;
    private $maxNumberOfClients;

    /**
     * Getter for serverId
     *
     * @return string
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * Setter for serverId
     *
     * @param string $serverId
     */
    public function setServerId($serverId)
    {
        $this->serverId = $serverId;
    }

    /**
     * Getter for online
     *
     * @return boolean
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Setter for online
     *
     * @param boolean $online
     */
    public function setOnline($online)
    {
        $this->online = (bool)$online;
    }

    /**
     * Getter for connectUrl
     *
     * @return string
     */
    public function getConnectUrl()
    {
        return $this->connectUrl;
    }

    /**
     * Setter for connectUrl
     *
     * @param string $connectUrl
     */
    public function setConnectUrl($connectUrl)
    {
        $this->connectUrl = $connectUrl;
    }

    /**
     * Getter for rootChannel
     *
     * @return MurmurChannelModel
     */
    public function getRootChannel()
    {
        return $this->rootChannel;
    }

    /**
     * Setter for rootChannel
     *
     * @param MurmurChannelModel $rootChannel
     */
    public function setRootChannel($rootChannel)
    {
        $this->rootChannel = $rootChannel;
    }

    /**
     * Getter for numberOfClients
     *
     * @return int
     */
    public function getNumberOfClients()
    {
        return $this->numberOfClients;
    }

    /**
     * Setter for numberOfClients
     *
     * @param int $numberOfClients
     */
    public function setNumberOfClients($numberOfClients)
    {
        $this->numberOfClients = (int)$numberOfClients;
    }

    /**
     * Getter for numberOfChannels
     *
     * @return int
     */
    public function getNumberOfChannels()
    {
        return $this->numberOfChannels;
    }

    /**
     * Setter for numberOfChannels
     *
     * @param int $numberOfChannels
     */
    public function setNumberOfChannels($numberOfChannels)
    {
        $this->numberOfChannels = (int)$numberOfChannels;
    }

    /**
     * Getter for maxNumberOfClients
     *
     * @return int
     */
    public function getMaxNumberOfClients()
    {
        return $this->maxNumberOfClients;
    }

    /**
     * Setter for maxNumberOfClients
     *
     * @param int $maxNumberOfClients
     */
    public function setMaxNumberOfClients($maxNumberOfClients)
    {
        $this->maxNumberOfClients = (int)$maxNumberOfClients;
    }
}