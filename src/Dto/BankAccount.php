<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for BankAccount data
 * 
 * @author admin
 */
class BankAccount {

    /**
     * ID bankovního účtu
     *   
     * @var int
     */
    private $id;

    /**
     * Název
     *   
     * @var string
     */
    private $name;

    /**
     * Číslo účtu
     *   
     * @var string
     */
    private $number;

    /**
     * Měna
     *   
     * @var string
     */
    private $currency;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData) {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->name = Utils::getValueOrNull($arrayData, 'name');
        $this->number = Utils::getValueOrNull($arrayData, 'number');
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getCurrency() {
        return $this->currency;
    }

}
