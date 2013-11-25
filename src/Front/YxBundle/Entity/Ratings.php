<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ratings
 */
class Ratings
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
    private $jokeId;

    /**
     * @var string
     */
    private $jokeType;

    /**
     * @var string
     */
    private $userRating;


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
     * @return Ratings
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
     * Set jokeId
     *
     * @param integer $jokeId
     * @return Ratings
     */
    public function setJokeId($jokeId)
    {
        $this->jokeId = $jokeId;
    
        return $this;
    }

    /**
     * Get jokeId
     *
     * @return integer 
     */
    public function getJokeId()
    {
        return $this->jokeId;
    }

    /**
     * Set jokeType
     *
     * @param string $jokeType
     * @return Ratings
     */
    public function setJokeType($jokeType)
    {
        $this->jokeType = $jokeType;
    
        return $this;
    }

    /**
     * Get jokeType
     *
     * @return string 
     */
    public function getJokeType()
    {
        return $this->jokeType;
    }

    /**
     * Set userRating
     *
     * @param string $userRating
     * @return Ratings
     */
    public function setUserRating($userRating)
    {
        $this->userRating = $userRating;
    
        return $this;
    }

    /**
     * Get userRating
     *
     * @return string 
     */
    public function getUserRating()
    {
        return $this->userRating;
    }
}
