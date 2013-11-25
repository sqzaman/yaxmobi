<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ringtones
 */
class Ringtones
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $ringtone;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var boolean
     */
    private $status;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $myxerTag;

    /**
     * @var integer
     */
    private $category;

    /**
     * @var integer
     */
    private $statPc;

    /**
     * @var integer
     */
    private $statPhone;

    /**
     * @var string
     */
    private $prewRingtone;


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
     * Set title
     *
     * @param string $title
     * @return Ringtones
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Ringtones
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set ringtone
     *
     * @param string $ringtone
     * @return Ringtones
     */
    public function setRingtone($ringtone)
    {
        $this->ringtone = $ringtone;
    
        return $this;
    }

    /**
     * Get ringtone
     *
     * @return string 
     */
    public function getRingtone()
    {
        return $this->ringtone;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Ringtones
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Ringtones
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Ringtones
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
     * Set price
     *
     * @param string $price
     * @return Ringtones
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set myxerTag
     *
     * @param string $myxerTag
     * @return Ringtones
     */
    public function setMyxerTag($myxerTag)
    {
        $this->myxerTag = $myxerTag;
    
        return $this;
    }

    /**
     * Get myxerTag
     *
     * @return string 
     */
    public function getMyxerTag()
    {
        return $this->myxerTag;
    }

    /**
     * Set category
     *
     * @param integer $category
     * @return Ringtones
     */
    public function setCategory($category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return integer 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set statPc
     *
     * @param integer $statPc
     * @return Ringtones
     */
    public function setStatPc($statPc)
    {
        $this->statPc = $statPc;
    
        return $this;
    }

    /**
     * Get statPc
     *
     * @return integer 
     */
    public function getStatPc()
    {
        return $this->statPc;
    }

    /**
     * Set statPhone
     *
     * @param integer $statPhone
     * @return Ringtones
     */
    public function setStatPhone($statPhone)
    {
        $this->statPhone = $statPhone;
    
        return $this;
    }

    /**
     * Get statPhone
     *
     * @return integer 
     */
    public function getStatPhone()
    {
        return $this->statPhone;
    }

    /**
     * Set prewRingtone
     *
     * @param string $prewRingtone
     * @return Ringtones
     */
    public function setPrewRingtone($prewRingtone)
    {
        $this->prewRingtone = $prewRingtone;
    
        return $this;
    }

    /**
     * Get prewRingtone
     *
     * @return string 
     */
    public function getPrewRingtone()
    {
        return $this->prewRingtone;
    }
    
    /**
     * Constructs a new instance of Post.
     */
    public function __construct()
    {
        $this->date = new \DateTime();
    }
    
    
}
