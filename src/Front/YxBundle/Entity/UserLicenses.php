<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserLicenses
 */
class UserLicenses
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
     * @var boolean
     */
    private $issued;

    /**
     * @var integer
     */
    private $songId;

    /**
     * @var string
     */
    private $licMd5;


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
     * @return UserLicenses
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
     * Set issued
     *
     * @param boolean $issued
     * @return UserLicenses
     */
    public function setIssued($issued)
    {
        $this->issued = $issued;
    
        return $this;
    }

    /**
     * Get issued
     *
     * @return boolean 
     */
    public function getIssued()
    {
        return $this->issued;
    }

    /**
     * Set songId
     *
     * @param integer $songId
     * @return UserLicenses
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
     * Set licMd5
     *
     * @param string $licMd5
     * @return UserLicenses
     */
    public function setLicMd5($licMd5)
    {
        $this->licMd5 = $licMd5;
    
        return $this;
    }

    /**
     * Get licMd5
     *
     * @return string 
     */
    public function getLicMd5()
    {
        return $this->licMd5;
    }
}
