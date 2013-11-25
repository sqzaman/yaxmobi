<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Songs
 */
class Songs
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $composition;

    /**
     * @var integer
     */
    private $singerId;

    /**
     * @var integer
     */
    private $albumId;

    /**
     * @var integer
     */
    private $genreId;

    /**
     * @var integer
     */
    private $year;

    /**
     * @var float
     */
    private $rate;

    /**
     * @var integer
     */
    private $grade;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $paid;
    
    /**
     * @var string
     */
    private $myxerTag;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $modified;

    /**
     * @var string
     */
    private $duration;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $sampleFile;

    /**
     * @var float
     */
    private $ratepc;

    /**
     * @var string
     */
    private $drm;

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
    private $orFile;

    /**
     * @var string
     */
    private $sampleFileBefore;

    /**
     * @var string
     */
    private $tag;

    /**
     * @var integer
     */
    private $view;


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
     * Set composition
     *
     * @param string $composition
     * @return Songs
     */
    public function setComposition($composition)
    {
        $this->composition = $composition;
    
        return $this;
    }

    /**
     * Get composition
     *
     * @return string 
     */
    public function getComposition()
    {
        return $this->composition;
    }

    /**
     * Set singerId
     *
     * @param integer $singerId
     * @return Songs
     */
    public function setSingerId($singerId)
    {
        $this->singerId = $singerId;
    
        return $this;
    }

    /**
     * Get singerId
     *
     * @return integer 
     */
    public function getSingerId()
    {
        return $this->singerId;
    }

    /**
     * Set albumId
     *
     * @param integer $albumId
     * @return Songs
     */
    public function setAlbumId($albumId)
    {
        $this->albumId = $albumId;
    
        return $this;
    }

    /**
     * Get albumId
     *
     * @return integer 
     */
    public function getAlbumId()
    {
        return $this->albumId;
    }

    /**
     * Set genreId
     *
     * @param integer $genreId
     * @return Songs
     */
    public function setGenreId($genreId)
    {
        $this->genreId = $genreId;
    
        return $this;
    }

    /**
     * Get genreId
     *
     * @return integer 
     */
    public function getGenreId()
    {
        return $this->genreId;
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
     * Set grade
     *
     * @param integer $grade
     * @return Songs
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    
        return $this;
    }

    /**
     * Get grade
     *
     * @return integer 
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Songs
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
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
     * Set created
     *
     * @param \DateTime $created
     * @return Songs
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
     * @return Songs
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
     * Set sampleFile
     *
     * @param string $sampleFile
     * @return Songs
     */
    public function setSampleFile($sampleFile)
    {
        $this->sampleFile = $sampleFile;
    
        return $this;
    }

    /**
     * Get sampleFile
     *
     * @return string 
     */
    public function getSampleFile()
    {
        return $this->sampleFile;
    }

    /**
     * Set ratepc
     *
     * @param float $ratepc
     * @return Songs
     */
    public function setRatepc($ratepc)
    {
        $this->ratepc = $ratepc;
    
        return $this;
    }

    /**
     * Get ratepc
     *
     * @return float 
     */
    public function getRatepc()
    {
        return $this->ratepc;
    }

    /**
     * Set drm
     *
     * @param string $drm
     * @return Songs
     */
    public function setDrm($drm)
    {
        $this->drm = $drm;
    
        return $this;
    }

    /**
     * Get drm
     *
     * @return string 
     */
    public function getDrm()
    {
        return $this->drm;
    }

    /**
     * Set statPc
     *
     * @param integer $statPc
     * @return Songs
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
     * @return Songs
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
     * Set orFile
     *
     * @param string $orFile
     * @return Songs
     */
    public function setOrFile($orFile)
    {
        $this->orFile = $orFile;
    
        return $this;
    }

    /**
     * Get orFile
     *
     * @return string 
     */
    public function getOrFile()
    {
        return $this->orFile;
    }

    /**
     * Set sampleFileBefore
     *
     * @param string $sampleFileBefore
     * @return Songs
     */
    public function setSampleFileBefore($sampleFileBefore)
    {
        $this->sampleFileBefore = $sampleFileBefore;
    
        return $this;
    }

    /**
     * Get sampleFileBefore
     *
     * @return string 
     */
    public function getSampleFileBefore()
    {
        return $this->sampleFileBefore;
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

    /**
     * Set view
     *
     * @param integer $view
     * @return Songs
     */
    public function setView($view)
    {
        $this->view = $view;
    
        return $this;
    }

    /**
     * Get view
     *
     * @return integer 
     */
    public function getView()
    {
        return $this->view;
    }
}
