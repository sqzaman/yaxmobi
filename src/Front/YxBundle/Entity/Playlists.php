<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playlists
 */
class Playlists
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
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
     * @param integer $userId
     * @return Playlists
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set ringtoneId
     *
     * @param integer $ringtoneId
     * @return Playlists
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
     * @return Playlists
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
}
