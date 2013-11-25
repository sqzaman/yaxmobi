<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * License
 */
class License
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $iduser;

    /**
     * @var integer
     */
    private $idfile;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $qwery;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $license;


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
     * Set iduser
     *
     * @param integer $iduser
     * @return License
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    
        return $this;
    }

    /**
     * Get iduser
     *
     * @return integer 
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set idfile
     *
     * @param integer $idfile
     * @return License
     */
    public function setIdfile($idfile)
    {
        $this->idfile = $idfile;
    
        return $this;
    }

    /**
     * Get idfile
     *
     * @return integer 
     */
    public function getIdfile()
    {
        return $this->idfile;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return License
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set qwery
     *
     * @param string $qwery
     * @return License
     */
    public function setQwery($qwery)
    {
        $this->qwery = $qwery;
    
        return $this;
    }

    /**
     * Get qwery
     *
     * @return string 
     */
    public function getQwery()
    {
        return $this->qwery;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return License
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
     * Set license
     *
     * @param string $license
     * @return License
     */
    public function setLicense($license)
    {
        $this->license = $license;
    
        return $this;
    }

    /**
     * Get license
     *
     * @return string 
     */
    public function getLicense()
    {
        return $this->license;
    }
}
