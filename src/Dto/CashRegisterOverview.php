<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for BankAccountOverview data
 *
 * @author iucto.cz
 */
class CashRegisterOverview extends RawData
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
     * Měna
     *
     * @var string
     */
    private $currency;

    /**
     *
     * @var bool
     */
    private $isdefault;

    /**
     *
     * @var int
     */
    private $initialState;


    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->name = Utils::getValueOrNull($arrayData, 'name');
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
        $this->isdefault = Utils::getValueOrNull($arrayData, 'isdefault');
        $this->initialState = Utils::getValueOrNull($arrayData, 'initial_state');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getIsdefault()
    {
        return $this->isdefault;
    }

    public function getInitialState()
    {
        return $this->initialState;
    }

}
