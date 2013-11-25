<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sending
 */
class Sending
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var integer
     */
    private $idSong;

    /**
     * @var integer
     */
    private $idUser;

    /**
     * @var string
     */
    private $answer;


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
     * Set type
     *
     * @param string $type
     * @return Sending
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
     * Set date
     *
     * @param \DateTime $date
     * @return Sending
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
     * Set idSong
     *
     * @param integer $idSong
     * @return Sending
     */
    public function setIdSong($idSong)
    {
        $this->idSong = $idSong;
    
        return $this;
    }

    /**
     * Get idSong
     *
     * @return integer 
     */
    public function getIdSong()
    {
        return $this->idSong;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     * @return Sending
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    
        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return Sending
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    
        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
