<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for BankAccount data
 *
 * @author iucto.cz
 */
class BankAccount
{

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
     * Počáteční stav účtu
     * @var int
     */
    private $initial_state;

    /**
     * @var string
     */
    private $swift;

    /**
     * @var string
     */
    private $iban;

    /**
     * Předčíslý účtu
     * @var string
     */
    private $account_prefix;

    /**
     * Číslo účtu
     * @var string
     */
    private $account_number;

    /**
     * Kód banky
     * @var string
     */
    private $bank_code;

    /**
     * Analytický účet
     * @var string
     */
    private $chart_account_id;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->name = Utils::getValueOrNull($arrayData, 'name');
        $this->number = Utils::getValueOrNull($arrayData, 'number');
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
        $this->initial_state = $arrayData['initial_state'];
        $this->swift = Utils::getValueOrNull($arrayData, 'swift');
        $this->iban = Utils::getValueOrNull($arrayData, 'iban');
        $this->account_prefix = $arrayData['account_prefix'];
        $this->account_number = $arrayData['account_number'];
        $this->bank_code = $arrayData['bank_code'];
        $this->chart_account_id = $arrayData['chart_account_id'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getInitialState()
    {
        return $this->initial_state;
    }

    /**
     * @return string
     */
    public function getSwift()
    {
        return $this->swift;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @return string
     */
    public function getAccountPrefix()
    {
        return $this->account_prefix;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->account_number;
    }

    /**
     * @return string
     */
    public function getBankCode()
    {
        return $this->bank_code;
    }
}
