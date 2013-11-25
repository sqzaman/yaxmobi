<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jokecategories
 */
class Jokecategories
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $catname;

    /**
     * @var integer
     */
    private $pcatid;

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
     * Set catname
     *
     * @param string $catname
     * @return Jokecategories
     */
    public function setCatname($catname)
    {
        $this->catname = $catname;
    
        return $this;
    }

    /**
     * Get catname
     *
     * @return string 
     */
    public function getCatname()
    {
        return $this->catname;
    }

    /**
     * Set pcatid
     *
     * @param integer $pcatid
     * @return Jokecategories
     */
    public function setPcatid($pcatid)
    {
        $this->pcatid = $pcatid;
    
        return $this;
    }

    /**
     * Get pcatid
     *
     * @return integer 
     */
    public function getPcatid()
    {
        return $this->pcatid;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Jokecategories
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
     * @return Jokecategories
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
     * @ORM\preUpdate
     */
    public function preUpdate()
    {
        $this->modified = new \DateTime();
    }
}
