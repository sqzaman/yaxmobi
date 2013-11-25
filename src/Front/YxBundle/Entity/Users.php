<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 */
class Users
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string $firstname
     */
    private $firstname;

    /**
     * @var string $lastname
     */
    private $lastname;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $countryId;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $mobilephone;

    /**
     * @var string
     */
    private $carrier;

    /**
     * @var string
     */
    private $workphone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $apiUserId;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \DateTime
     */
    private $birthdate;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $activationkey;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $modified;

    /**
     * @var \DateTime
     */
    private $dateSendJoke;

    /**
     * @var \DateTime
     */
    private $dateSendRing;

    /**
     * @var integer
     */
    private $countJoke;

    /**
     * @var integer
     */
    private $countRing;

    /**
     * @var integer
     */
    private $deliveryType;

    /**
     * @var \DateTime
     */
    private $dateSubscript;

    /**
     * @var integer
     */
    private $idSubscript;


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
     * Set firstname
     *
     * @param string $firstname
     * @return Users
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Users
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Users
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Users
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Users
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Users
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set countryId
     *
     * @param string $countryId
     * @return Users
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;
    
        return $this;
    }

    /**
     * Get countryId
     *
     * @return string 
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return Users
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    
        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set mobilephone
     *
     * @param string $mobilephone
     * @return Users
     */
    public function setMobilephone($mobilephone)
    {
        $this->mobilephone = $mobilephone;
    
        return $this;
    }

    /**
     * Get mobilephone
     *
     * @return string 
     */
    public function getMobilephone()
    {
        return $this->mobilephone;
    }

    /**
     * Set carrier
     *
     * @param string $carrier
     * @return Users
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
    
        return $this;
    }

    /**
     * Get carrier
     *
     * @return string 
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set workphone
     *
     * @param string $workphone
     * @return Users
     */
    public function setWorkphone($workphone)
    {
        $this->workphone = $workphone;
    
        return $this;
    }

    /**
     * Get workphone
     *
     * @return string 
     */
    public function getWorkphone()
    {
        return $this->workphone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set apiUserId
     *
     * @param string $apiUserId
     * @return Users
     */
    public function setApiUserId($apiUserId)
    {
        $this->apiUserId = $apiUserId;
    
        return $this;
    }

    /**
     * Get apiUserId
     *
     * @return string 
     */
    public function getApiUserId()
    {
        return $this->apiUserId;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return Users
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    
        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Users
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
     * Set activationkey
     *
     * @param string $activationkey
     * @return Users
     */
    public function setActivationkey($activationkey)
    {
        $this->activationkey = $activationkey;
    
        return $this;
    }

    /**
     * Get activationkey
     *
     * @return string 
     */
    public function getActivationkey()
    {
        return $this->activationkey;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Users
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
     * @return Users
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
     * Set dateSendJoke
     *
     * @param \DateTime $dateSendJoke
     * @return Users
     */
    public function setDateSendJoke($dateSendJoke)
    {
        $this->dateSendJoke = $dateSendJoke;
    
        return $this;
    }

    /**
     * Get dateSendJoke
     *
     * @return \DateTime 
     */
    public function getDateSendJoke()
    {
        return $this->dateSendJoke;
    }

    /**
     * Set dateSendRing
     *
     * @param \DateTime $dateSendRing
     * @return Users
     */
    public function setDateSendRing($dateSendRing)
    {
        $this->dateSendRing = $dateSendRing;
    
        return $this;
    }

    /**
     * Get dateSendRing
     *
     * @return \DateTime 
     */
    public function getDateSendRing()
    {
        return $this->dateSendRing;
    }

    /**
     * Set countJoke
     *
     * @param integer $countJoke
     * @return Users
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
     * @return Users
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
     * Set deliveryType
     *
     * @param integer $deliveryType
     * @return Users
     */
    public function setDeliveryType($deliveryType)
    {
        $this->deliveryType = $deliveryType;
    
        return $this;
    }

    /**
     * Get deliveryType
     *
     * @return integer 
     */
    public function getDeliveryType()
    {
        return $this->deliveryType;
    }

    /**
     * Set dateSubscript
     *
     * @param \DateTime $dateSubscript
     * @return Users
     */
    public function setDateSubscript($dateSubscript)
    {
        $this->dateSubscript = $dateSubscript;
    
        return $this;
    }

    /**
     * Get dateSubscript
     *
     * @return \DateTime 
     */
    public function getDateSubscript()
    {
        return $this->dateSubscript;
    }

    /**
     * Set idSubscript
     *
     * @param integer $idSubscript
     * @return Users
     */
    public function setIdSubscript($idSubscript)
    {
        $this->idSubscript = $idSubscript;
    
        return $this;
    }

    /**
     * Get idSubscript
     *
     * @return integer 
     */
    public function getIdSubscript()
    {
        return $this->idSubscript;
    }
    
    /**
     * Constructs a new instance of Post.
     */
    public function __construct(){
        $this->created = new \DateTime();
        $this->status = 'N';
        $this->carrier = '';
        $this->countJoke = '';
        $this->countRing = '';
        $this->idSubscript = '';
    }
    
}
