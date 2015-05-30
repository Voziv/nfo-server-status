<?php namespace lrobert\NFOServerStatus\Murmur;

class MurmurChannelModel
{
    private $id;
    private $name;
    private $isLocked;
    private $clients;
    private $channels;
    private $parentChannel;

    /**
     * Getter for id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter for id
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter for name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter for name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Getter for isLocked
     *
     * @return boolean
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * Setter for isLocked
     *
     * @param boolean $isLocked
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;
    }

    /**
     * Getter for clients
     *
     * @return MurmurClientModel[]
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Setter for clients
     *
     * @param MurmurClientModel[] $clients
     */
    public function setClients($clients)
    {
        $this->clients = $clients;
    }

    /**
     * Getter for channels
     *
     * @return MurmurChannelModel[]
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * Setter for channels
     *
     * @param MurmurChannelModel[] $channels
     */
    public function setChannels($channels)
    {
        $this->channels = $channels;
    }

    /**
     * Getter for parentChannel
     *
     * @return MurmurChannelModel
     */
    public function getParentChannel()
    {
        return $this->parentChannel;
    }

    /**
     * Setter for parentChannel
     *
     * @param MurmurChannelModel $parentChannel
     */
    public function setParentChannel($parentChannel)
    {
        $this->parentChannel = $parentChannel;
    }
}