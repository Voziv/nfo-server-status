<?php namespace lrobert\NFOServerStatus\Murmur;

class MurmurClientModel
{
    private $id;
    private $name;
    private $timeOnline;
    private $channel;
    private $admin;

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
     * Getter for timeOnline
     *
     * @return string
     */
    public function getTimeOnline()
    {
        return $this->timeOnline;
    }

    /**
     * Setter for timeOnline
     *
     * @param string $timeOnline
     */
    public function setTimeOnline($timeOnline)
    {
        $this->timeOnline = $timeOnline;
    }

    /**
     * Getter for channel
     *
     * @return MurmurChannelModel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Setter for channel
     *
     * @param MurmurChannelModel $channel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
    }

    /**
     * Getter for admin
     *
     * @return string
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Setter for admin
     *
     * @param string $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }
}