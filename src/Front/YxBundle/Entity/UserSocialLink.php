<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserSocialLink
 */
class UserSocialLink
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
     * @var string
     */
    private $userToken;


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
     * @return UserSocialLink
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
     * Set userToken
     *
     * @param string $userToken
     * @return UserSocialLink
     */
    public function setUserToken($userToken)
    {
        $this->userToken = $userToken;
    
        return $this;
    }

    /**
     * Get userToken
     *
     * @return string 
     */
    public function getUserToken()
    {
        return $this->userToken;
    }
}
