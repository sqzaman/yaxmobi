<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Downloads
 */
class Downloads
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var integer
     */
    private $carrier;

    /**
     * @var integer
     */
    private $song;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Downloads
     */
    public function setUser($user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Downloads
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set carrier
     *
     * @param integer $carrier
     * @return Downloads
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
    
        return $this;
    }

    /**
     * Get carrier
     *
     * @return integer 
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set song
     *
     * @param integer $song
     * @return Downloads
     */
    public function setSong($song)
    {
        $this->song = $song;
    
        return $this;
    }

    /**
     * Get song
     *
     * @return integer 
     */
    public function getSong()
    {
        return $this->song;
    }
}
