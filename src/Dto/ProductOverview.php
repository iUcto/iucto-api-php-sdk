<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for ProductDetail data
 *
 * @author iucto.cz
 */
class ProductOverview
{

    /**
     * (povinné)
     *
     * @var string
     */
    private $name;
    private $amount;
    private $unit;
    private $price;
    private $is_vat_price;
    private $vat_rate;
    private $currency;
    private $bar_code;
    private $department_id;
    private $contract_id;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) return;

        $this->name = Utils::getValueOrNull($arrayData, 'name');
        $this->amount = Utils::getValueOrNull($arrayData, 'amount');
        $this->unit = Utils::getValueOrNull($arrayData, 'unit');
        $this->price = Utils::getValueOrNull($arrayData, 'price');
        $this->is_vat_price = Utils::getValueOrNull($arrayData, 'is_vat_price');
        $this->vat_rate = Utils::getValueOrNull($arrayData, 'vat_rate');
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
        $this->bar_code = Utils::getValueOrNull($arrayData, 'bar_code');
        $this->department_id = Utils::getValueOrNull($arrayData, 'department_id');
        $this->contract_id = Utils::getValueOrNull($arrayData, 'contract_id');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed|null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed|null
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return mixed|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed|null
     */
    public function getIsVatPrice()
    {
        return $this->is_vat_price;
    }

    /**
     * @return mixed|null
     */
    public function getVatRate()
    {
        return $this->vat_rate;
    }

    /**
     * @return mixed|null
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed|null
     */
    public function getBarCode()
    {
        return $this->bar_code;
    }

    /**
     * @return mixed|null
     */
    public function getDepartmentId()
    {
        return $this->department_id;
    }

    /**
     * @return mixed|null
     */
    public function getContractId()
    {
        return $this->contract_id;
    }


    public function toArray()
    {
        return [
            'name' => $this->name,
            'amount' => $this->amount,
            'unit' => $this->unit,
            'price' => $this->price,
            'is_vat_price' => $this->is_vat_price,
            'vat_rate' => $this->vat_rate,
            'currency' => $this->currency,
            'bar_code' => $this->bar_code,
            'department_id' => $this->department_id,
            'contract_id' => $this->contract_id,
        ];
    }

}
