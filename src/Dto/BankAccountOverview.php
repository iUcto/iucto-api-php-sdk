<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for BankAccountOverview data
 *
 * @author iucto.cz
 */
class BankAccountOverview extends RawData
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
     *
     * @var bool
     */
    private $visible;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->name = Utils::getValueOrNull($arrayData, 'name');
        $this->number = Utils::getValueOrNull($arrayData, 'number');
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
        $this->isdefault = Utils::getValueOrNull($arrayData, 'isdefault');
        $this->initialState = Utils::getValueOrNull($arrayData, 'initial_state');
        $this->visible = Utils::getValueOrNull($arrayData, 'visible');
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

    public function getIsdefault()
    {
        return $this->isdefault;
    }

    public function getInitialState()
    {
        return $this->initialState;
    }

    public function getVisible()
    {
        return $this->visible;
    }

}
