<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for ProductDetail data
 *
 * @author iucto.cz
 */
class ProductOverview extends RawData
{


    protected $id;
    protected $name;
    protected $amount;
    protected $unit;
    protected $price;
    protected $is_vat_price;
    protected $vat_rate;
    protected $currency;
    protected $bar_code;
    protected $department_id;
    protected $contract_id;
    protected $external_code;
    protected $is_hidden;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);
        if (empty($arrayData)) return;

        $this->id = Utils::getValueOrNull($arrayData, 'id');
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
        $this->external_code = Utils::getValueOrNull($arrayData, 'external_code');
        $this->is_hidden = Utils::getValueOrNull($arrayData, 'is_hidden');
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

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed|null
     */
    public function getExternalCode()
    {
        return $this->external_code;
    }

    /**
     * @return mixed|null
     */
    public function isHidden()
    {
        return $this->is_hidden;
    }


    public function toArray()
    {
        return [
            'id' => $this->id,
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
            'external_code' => $this->external_code,
            'is_hidden' => $this->is_hidden,
        ];
    }

}
