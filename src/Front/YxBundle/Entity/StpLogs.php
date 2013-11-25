<?php

namespace Front\YxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StpLogs
 */
class StpLogs
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $api;

    /**
     * @var string
     */
    private $result;

    /**
     * @var string
     */
    private $data;


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
     * Set api
     *
     * @param string $api
     * @return StpLogs
     */
    public function setApi($api)
    {
        $this->api = $api;
    
        return $this;
    }

    /**
     * Get api
     *
     * @return string 
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Set result
     *
     * @param string $result
     * @return StpLogs
     */
    public function setResult($result)
    {
        $this->result = $result;
    
        return $this;
    }

    /**
     * Get result
     *
     * @return string 
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return StpLogs
     */
    public function setData($data)
    {
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }
}
