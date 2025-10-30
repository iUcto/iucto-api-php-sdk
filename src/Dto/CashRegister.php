<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for BankAccount data
 *
 * @author iucto.cz
 */
class CashRegister extends RawData
{

    /**
     * ID CashRegister
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
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->name = Utils::getValueOrNull($arrayData, 'name');
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
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

}
