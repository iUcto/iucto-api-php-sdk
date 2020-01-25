<?php

namespace IUcto\Command;

use IUcto\Utils;

/**
 * DTO for ProductDetail data
 *
 * @author iucto.cz
 */
class SaveProduct
{

    private $name;
    private $amount;
    private $unit;
    private $price;
    private $is_vat_price;
    private $vat_rate;
    private $currency;
    private $bar_code;
    private $accountentry_type_id;
    private $chart_account_id;
    private $vattype_id;
    private $vat_chart_id;
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
        $this->accountentry_type_id = Utils::getValueOrNull($arrayData, 'accountentry_type_id');
        $this->chart_account_id = Utils::getValueOrNull($arrayData, 'chart_account_id');
        $this->vattype_id = Utils::getValueOrNull($arrayData, 'vattype_id');
        $this->vat_chart_id = Utils::getValueOrNull($arrayData, 'vat_chart_id');
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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->is_default;
    }

    /**
     * @param bool $is_default
     */
    public function setAsDefault($is_default)
    {
        $this->is_default = $is_default;
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
            'accountentry_type_id' => $this->accountentry_type_id,
            'chart_account_id' => $this->chart_account_id,
            'vattype_id' => $this->vattype_id,
            'vat_chart_id' => $this->vat_chart_id,
            'department_id' => $this->department_id,
            'contract_id' => $this->contract_id,
        ];
    }

}
