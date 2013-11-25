<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * States
 */
class States
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $statename;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $modified;

    /**
     * @var integer
     */
    private $countriesId;


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
     * Set statename
     *
     * @param string $statename
     * @return States
     */
    public function setStatename($statename)
    {
        $this->statename = $statename;
    
        return $this;
    }

    /**
     * Get statename
     *
     * @return string 
     */
    public function getStatename()
    {
        return $this->statename;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return States
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
     * @return States
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
     * Set countriesId
     *
     * @param integer $countriesId
     * @return States
     */
    public function setCountriesId($countriesId)
    {
        $this->countriesId = $countriesId;
    
        return $this;
    }

    /**
     * Get countriesId
     *
     * @return integer 
     */
    public function getCountriesId()
    {
        return $this->countriesId;
    }
}
