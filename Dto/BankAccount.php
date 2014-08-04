<?php

/**
 * Description of BankAccount
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

    public function __construct(array $dataArray) {
        $this->id = ArrayUtils::getValueOrNull($dataArray, 'id');
        $this->name = ArrayUtils::getValueOrNull($dataArray, 'name');
        $this->number = ArrayUtils::getValueOrNull($dataArray, 'number');
        $this->currency = ArrayUtils::getValueOrNull($dataArray, 'currency');
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
