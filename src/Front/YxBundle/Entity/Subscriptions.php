<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscriptions
 */
class Subscriptions
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $countJoke;

    /**
     * @var integer
     */
    private $countRing;

    /**
     * @var float
     */
    private $price;

    /**
     * @var integer
     */
    private $perJoke;

    /**
     * @var integer
     */
    private $perRing;

    /**
     * @var string
     */
    private $deliveryMail;

    /**
     * @var string
     */
    private $deliveryPhone;

    /**
     * @var string
     */
    private $deliveryManual;


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
     * Set name
     *
     * @param string $name
     * @return Subscriptions
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set countJoke
     *
     * @param integer $countJoke
     * @return Subscriptions
     */
    public function setCountJoke($countJoke)
    {
        $this->countJoke = $countJoke;
    
        return $this;
    }

    /**
     * Get countJoke
     *
     * @return integer 
     */
    public function getCountJoke()
    {
        return $this->countJoke;
    }

    /**
     * Set countRing
     *
     * @param integer $countRing
     * @return Subscriptions
     */
    public function setCountRing($countRing)
    {
        $this->countRing = $countRing;
    
        return $this;
    }

    /**
     * Get countRing
     *
     * @return integer 
     */
    public function getCountRing()
    {
        return $this->countRing;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Subscriptions
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set perJoke
     *
     * @param integer $perJoke
     * @return Subscriptions
     */
    public function setPerJoke($perJoke)
    {
        $this->perJoke = $perJoke;
    
        return $this;
    }

    /**
     * Get perJoke
     *
     * @return integer 
     */
    public function getPerJoke()
    {
        return $this->perJoke;
    }

    /**
     * Set perRing
     *
     * @param integer $perRing
     * @return Subscriptions
     */
    public function setPerRing($perRing)
    {
        $this->perRing = $perRing;
    
        return $this;
    }

    /**
     * Get perRing
     *
     * @return integer 
     */
    public function getPerRing()
    {
        return $this->perRing;
    }

    /**
     * Set deliveryMail
     *
     * @param string $deliveryMail
     * @return Subscriptions
     */
    public function setDeliveryMail($deliveryMail)
    {
        $this->deliveryMail = $deliveryMail;
    
        return $this;
    }

    /**
     * Get deliveryMail
     *
     * @return string 
     */
    public function getDeliveryMail()
    {
        return $this->deliveryMail;
    }

    /**
     * Set deliveryPhone
     *
     * @param string $deliveryPhone
     * @return Subscriptions
     */
    public function setDeliveryPhone($deliveryPhone)
    {
        $this->deliveryPhone = $deliveryPhone;
    
        return $this;
    }

    /**
     * Get deliveryPhone
     *
     * @return string 
     */
    public function getDeliveryPhone()
    {
        return $this->deliveryPhone;
    }

    /**
     * Set deliveryManual
     *
     * @param string $deliveryManual
     * @return Subscriptions
     */
    public function setDeliveryManual($deliveryManual)
    {
        $this->deliveryManual = $deliveryManual;
    
        return $this;
    }

    /**
     * Get deliveryManual
     *
     * @return string 
     */
    public function getDeliveryManual()
    {
        return $this->deliveryManual;
    }
}
