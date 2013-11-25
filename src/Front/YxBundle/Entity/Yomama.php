<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Yomamma
 */
class Yomama
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
     * @var boolean
     */
    private $status;
    
    
    
    /**
     * @var integer
     */
    private $year;
    
    /**
     * @var string
     */
    private $duration;
    
    /**
     * @var float
     */
    private $rate;

    /**
     * @var string
     */
    private $type;
    
    /**
     * @var string
     */
    private $paid;

    /**
     * @var string
     */
    private $myxerTag;
    
    /**
     * @var string
     */
    private $tag;
    
    /**
     * @var integer
     */
    private $category;

    /**
     * @var string
     */
    private $yomamaFile;


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
     * @return Yomamma
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
     * @return Yomamma
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
     * Set status
     *
     * @param boolean $status
     * @return Yomamma
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
     * Set category
     *
     * @param integer $category
     * @return Yomamma
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
     * Set prewRingtone
     *
     * @param string $prewRingtone
     * @return Yomamma
     */
    public function setYomamaFile($yomamaFile)
    {
        $this->yomamaFile = $yomamaFile;
    
        return $this;
    }

    /**
     * Get prewRingtone
     *
     * @return string 
     */
    public function getYomamaFile()
    {
        return $this->yomamaFile;
    }
    
    /**
     * Set year
     *
     * @param integer $year
     * @return Songs
     */
    public function setYear($year)
    {
        $this->year = $year;
    
        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return Songs
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    
        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
    }
    
    /**
     * Set rate
     *
     * @param float $rate
     * @return Songs
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    
        return $this;
    }

    /**
     * Get rate
     *
     * @return float 
     */
    public function getRate()
    {
        return $this->rate;
    }
    
    /**
     * Set type
     *
     * @param string $type
     * @return Songs
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
     * Set paid
     *
     * @param string $paid
     * @return Songs
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
    
        return $this;
    }

    /**
     * Get paid
     *
     * @return string 
     */
    public function getPaid()
    {
        return $this->paid;
    }
    
    /**
     * Set myxerTag
     *
     * @param string $myxerTag
     * @return Songs
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
     * Set tag
     *
     * @param string $tag
     * @return Songs
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    
        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
    }
    
}
