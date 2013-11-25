<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartitems
 */
class Cartitems
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $songId;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $modified;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $statuspc;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $typeUpl;


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
     * Set songId
     *
     * @param integer $songId
     * @return Cartitems
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
     * Set userId
     *
     * @param integer $userId
     * @return Cartitems
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
     * Set created
     *
     * @param \DateTime $created
     * @return Cartitems
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

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Cartitems
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    
        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Cartitems
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set statuspc
     *
     * @param string $statuspc
     * @return Cartitems
     */
    public function setStatuspc($statuspc)
    {
        $this->statuspc = $statuspc;
    
        return $this;
    }

    /**
     * Get statuspc
     *
     * @return string 
     */
    public function getStatuspc()
    {
        return $this->statuspc;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Cartitems
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set typeUpl
     *
     * @param integer $typeUpl
     * @return Cartitems
     */
    public function setTypeUpl($typeUpl)
    {
        $this->typeUpl = $typeUpl;
    
        return $this;
    }

    /**
     * Get typeUpl
     *
     * @return integer 
     */
    public function getTypeUpl()
    {
        return $this->typeUpl;
    }
}
