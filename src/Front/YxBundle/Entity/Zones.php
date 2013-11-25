<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zones
 */
class Zones
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $zonecountryid;

    /**
     * @var string
     */
    private $zonecode;

    /**
     * @var string
     */
    private $zonename;


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
     * Set zonecountryid
     *
     * @param integer $zonecountryid
     * @return Zones
     */
    public function setZonecountryid($zonecountryid)
    {
        $this->zonecountryid = $zonecountryid;
    
        return $this;
    }

    /**
     * Get zonecountryid
     *
     * @return integer 
     */
    public function getZonecountryid()
    {
        return $this->zonecountryid;
    }

    /**
     * Set zonecode
     *
     * @param string $zonecode
     * @return Zones
     */
    public function setZonecode($zonecode)
    {
        $this->zonecode = $zonecode;
    
        return $this;
    }

    /**
     * Get zonecode
     *
     * @return string 
     */
    public function getZonecode()
    {
        return $this->zonecode;
    }

    /**
     * Set zonename
     *
     * @param string $zonename
     * @return Zones
     */
    public function setZonename($zonename)
    {
        $this->zonename = $zonename;
    
        return $this;
    }

    /**
     * Get zonename
     *
     * @return string 
     */
    public function getZonename()
    {
        return $this->zonename;
    }
}
