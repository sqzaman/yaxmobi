<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plans
 */
class Plans
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $planname;

    /**
     * @var float
     */
    private $plancost;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $modified;


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
     * Set planname
     *
     * @param string $planname
     * @return Plans
     */
    public function setPlanname($planname)
    {
        $this->planname = $planname;
    
        return $this;
    }

    /**
     * Get planname
     *
     * @return string 
     */
    public function getPlanname()
    {
        return $this->planname;
    }

    /**
     * Set plancost
     *
     * @param float $plancost
     * @return Plans
     */
    public function setPlancost($plancost)
    {
        $this->plancost = $plancost;
    
        return $this;
    }

    /**
     * Get plancost
     *
     * @return float 
     */
    public function getPlancost()
    {
        return $this->plancost;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Plans
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
     * Set created
     *
     * @param \DateTime $created
     * @return Plans
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
     * @return Plans
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
     * Constructs a new instance of Post.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->modified = new \DateTime();
    }
    
    /**
     * Invoked before the entity is updated.
     * 
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->modified = new \DateTime();
    }
}
