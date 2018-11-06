<?php

namespace IUcto\Command;

use IUcto\Utils;

/**
 * Description of SaveCustomer
 *
 * @author iucto.cz
 */
class SaveBankAccount
{

    /**
     * Název
     *
     * @var string
     */
    private $name;

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
     * Analytický účet ze skupiny 221
     * @var string
     */
    private $chart_account_id;

    /**
     * Analytický účet platný od
     * @var string date
     */
    private $chart_account_valid_from;

    /**
     * Příznak zda jde o výchozí účet
     * @var bool
     */
    private $isDefault;

    function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) {
            return;
        }

        $this->name = $arrayData['name'];
        $this->currency = $arrayData['currency'];
        $this->initial_state = $arrayData['initial_state'];
        $this->swift = Utils::getValueOrNull($arrayData, 'swift');
        $this->iban = Utils::getValueOrNull($arrayData, 'iban');
        $this->account_prefix = $arrayData['account_prefix'];
        $this->account_number = $arrayData['account_number'];
        $this->bank_code = $arrayData['bank_code'];
        $this->chart_account_id = Utils::getValueOrNull($arrayData, 'chart_account_id');
        $this->chart_account_valid_from = Utils::getDateTimeFrom($arrayData['chart_account_valid_from']);
        $this->isDefault = $arrayData['isdefault'];
    }


    public function toArray()
    {
        return [
            'name' => $this->name,
            'currency' => $this->currency,
            'initial_state' => $this->initial_state,
            'swift' => $this->swift,
            'iban' => $this->iban,
            'account_prefix' => $this->account_prefix,
            'account_number' => $this->account_number,
            'bank_code' => $this->bank_code,
            'chart_account_id' => $this->chart_account_id,
            'chart_account_valid_from' => !empty($this->chart_account_valid_from) ? $this->chart_account_valid_from->format('Y-m-d') : null,
            'isdefault' => $this->isDefault,
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getInitialState()
    {
        return $this->initial_state;
    }

    /**
     * @param int $initial_state
     */
    public function setInitialState($initial_state)
    {
        $this->initial_state = $initial_state;
    }

    /**
     * @return string
     */
    public function getSwift()
    {
        return $this->swift;
    }

    /**
     * @param string $swift
     */
    public function setSwift($swift)
    {
        $this->swift = $swift;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * @return string
     */
    public function getAccountPrefix()
    {
        return $this->account_prefix;
    }

    /**
     * @param string $account_prefix
     */
    public function setAccountPrefix($account_prefix)
    {
        $this->account_prefix = $account_prefix;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->account_number;
    }

    /**
     * @param string $account_number
     */
    public function setAccountNumber($account_number)
    {
        $this->account_number = $account_number;
    }

    /**
     * @return string
     */
    public function getBankCode()
    {
        return $this->bank_code;
    }

    /**
     * @param string $bank_code
     */
    public function setBankCode($bank_code)
    {
        $this->bank_code = $bank_code;
    }

    /**
     * @return string
     */
    public function getChartAccountId()
    {
        return $this->chart_account_id;
    }

    /**
     * @param string $chart_account_id
     */
    public function setChartAccountId($chart_account_id)
    {
        $this->chart_account_id = $chart_account_id;
    }

    /**
     * @return string
     */
    public function getChartAccountValidFrom()
    {
        return $this->chart_account_valid_from;
    }

    /**
     * @param \DateTime $chart_account_valid_from
     */
    public function setChartAccountValidFrom(\DateTime $chart_account_valid_from)
    {
        $this->chart_account_valid_from = $chart_account_valid_from;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    }


}
