<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orderdetails
 */
class Orderdetails
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $orderId;

    /**
     * @var integer
     */
    private $songId;

    /**
     * @var float
     */
    private $unitprice;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var float
     */
    private $discount;

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
     * Set orderId
     *
     * @param integer $orderId
     * @return Orderdetails
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    
        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set songId
     *
     * @param integer $songId
     * @return Orderdetails
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
     * Set unitprice
     *
     * @param float $unitprice
     * @return Orderdetails
     */
    public function setUnitprice($unitprice)
    {
        $this->unitprice = $unitprice;
    
        return $this;
    }

    /**
     * Get unitprice
     *
     * @return float 
     */
    public function getUnitprice()
    {
        return $this->unitprice;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Orderdetails
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set discount
     *
     * @param float $discount
     * @return Orderdetails
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    
        return $this;
    }

    /**
     * Get discount
     *
     * @return float 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Orderdetails
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
     * @return Orderdetails
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
}
