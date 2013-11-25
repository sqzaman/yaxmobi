<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wishes
 */
class Wishes
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var integer
     */
    private $ringtoneId;

    /**
     * @var integer
     */
    private $songId;

    /**
     * @var \DateTime
     */
    private $created;


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
     * Set userId
     *
     * @param string $userId
     * @return Wishes
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return string 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set ringtoneId
     *
     * @param integer $ringtoneId
     * @return Wishes
     */
    public function setRingtoneId($ringtoneId)
    {
        $this->ringtoneId = $ringtoneId;
    
        return $this;
    }

    /**
     * Get ringtoneId
     *
     * @return integer 
     */
    public function getRingtoneId()
    {
        return $this->ringtoneId;
    }

    /**
     * Set songId
     *
     * @param integer $songId
     * @return Wishes
     */
    public function setSongId($songId)
    {
        $this->songId = $songId;
    
        return $this;
    }

    /**
     * Get songId
     *
     * @return integer 
     */
    public function getSongId()
    {
        return $this->songId;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Wishes
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }
}
