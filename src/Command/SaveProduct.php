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
    private $external_code;
    private $is_hidden;

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
        $this->external_code = Utils::getValueOrNull($arrayData, 'external_code');
        $this->is_hidden = Utils::getValueOrNull($arrayData, 'is_hidden');
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed|null $name
     */
    public function setName( $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed|null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed|null $amount
     */
    public function setAmount( $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed|null
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param mixed|null $unit
     */
    public function setUnit( $unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return mixed|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed|null $price
     */
    public function setPrice( $price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed|null
     */
    public function getIsVatPrice()
    {
        return $this->is_vat_price;
    }

    /**
     * @param mixed|null $is_vat_price
     */
    public function setIsVatPrice( $is_vat_price)
    {
        $this->is_vat_price = $is_vat_price;
    }

    /**
     * @return mixed|null
     */
    public function getVatRate()
    {
        return $this->vat_rate;
    }

    /**
     * @param mixed|null $vat_rate
     */
    public function setVatRate( $vat_rate)
    {
        $this->vat_rate = $vat_rate;
    }

    /**
     * @return mixed|null
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed|null $currency
     */
    public function setCurrency( $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed|null
     */
    public function getBarCode()
    {
        return $this->bar_code;
    }

    /**
     * @param mixed|null $bar_code
     */
    public function setBarCode( $bar_code)
    {
        $this->bar_code = $bar_code;
    }

    /**
     * @return mixed|null
     */
    public function getAccountentryTypeId()
    {
        return $this->accountentry_type_id;
    }

    /**
     * @param mixed|null $accountentry_type_id
     */
    public function setAccountentryTypeId( $accountentry_type_id)
    {
        $this->accountentry_type_id = $accountentry_type_id;
    }

    /**
     * @return mixed|null
     */
    public function getChartAccountId()
    {
        return $this->chart_account_id;
    }

    /**
     * @param mixed|null $chart_account_id
     */
    public function setChartAccountId( $chart_account_id)
    {
        $this->chart_account_id = $chart_account_id;
    }

    /**
     * @return mixed|null
     */
    public function getVattypeId()
    {
        return $this->vattype_id;
    }

    /**
     * @param mixed|null $vattype_id
     */
    public function setVattypeId( $vattype_id)
    {
        $this->vattype_id = $vattype_id;
    }

    /**
     * @return mixed|null
     */
    public function getVatChartId()
    {
        return $this->vat_chart_id;
    }

    /**
     * @param mixed|null $vat_chart_id
     */
    public function setVatChartId( $vat_chart_id)
    {
        $this->vat_chart_id = $vat_chart_id;
    }

    /**
     * @return mixed|null
     */
    public function getDepartmentId()
    {
        return $this->department_id;
    }

    /**
     * @param mixed|null $department_id
     */
    public function setDepartmentId( $department_id)
    {
        $this->department_id = $department_id;
    }

    /**
     * @return mixed|null
     */
    public function getContractId()
    {
        return $this->contract_id;
    }

    /**
     * @param mixed|null $contract_id
     */
    public function setContractId( $contract_id)
    {
        $this->contract_id = $contract_id;
    }

    /**
     * @return mixed|null
     */
    public function getExternalCode()
    {
        return $this->external_code;
    }

    /**
     * @param mixed|null $external_code
     */
    public function setExternalCode($external_code)
    {
        $this->external_code = $external_code;
    }

    /**
     * @return mixed|null
     */
    public function isHidden()
    {
        return $this->is_hidden;
    }

    /**
     * @param mixed|null $is_hidden
     */
    public function setHidden($is_hidden)
    {
        $this->is_hidden = $is_hidden;
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
            'external_code' => $this->external_code,
            'is_hidden' => $this->is_hidden,
        ];
    }

}
