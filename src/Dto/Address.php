<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for Address data
 *
 * @author admin
 */
class Address {

    /**
     * 
     *   
     * @var string
     */
    private $street;

    /**
     * 
     *   
     * @var string
     */
    private $city;

    /**
     * 
     *   
     * @var string
     */
    private $postalcode;

    /**
     * 
     *   
     * @var string
     */
    private $country;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData) {
        $this->street = $arrayData['street'];
        $this->city = $arrayData['city'];
        $this->postalcode = $arrayData['postalcode'];
        $this->country = $arrayData['country'];
    }

    public function getStreet() {
        return $this->street;
    }

    public function getCity() {
        return $this->city;
    }

    public function getPostalcode() {
        return $this->postalcode;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setStreet($street) {
        $this->street = $street;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function toArray() {
        return array('street' => $this->street,
            'city' => $this->city,
            'postalcode' => $this->postalcode,
            'country' => $this->country);
    }

}
