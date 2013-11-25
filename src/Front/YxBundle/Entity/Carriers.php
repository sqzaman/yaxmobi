<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carriers
 */
class Carriers
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $carriername;


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
     * Set carriername
     *
     * @param string $carriername
     * @return Carriers
     */
    public function setCarriername($carriername)
    {
        $this->carriername = $carriername;
    
        return $this;
    }

    /**
     * Get carriername
     *
     * @return string 
     */
    public function getCarriername()
    {
        return $this->carriername;
    }
}
