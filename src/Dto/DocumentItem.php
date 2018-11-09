<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for DocumentItem data
 *
 * @author iucto.cz
 */
class DocumentItem
{

    /**
     * ID položky
     *
     * @var int(11)
     */
    private $id;

    /**
     * Počet (povinné)
     *
     * @var float(12,2)
     */
    private $amount;

    /**
     * Jednotka
     *
     * @var string(10)
     */
    private $unit;

    /**
     * Cena za jednotku (povinné)
     *
     * @var float(12,2)
     */
    private $price;

    /**
     * Popis (povinné)
     *
     * @var string(255)
     */
    private $text;

    /**
     * DPH
     *
     * @var float(5,2)
     */
    private $vat;

    /**
     * Typ účetní položky (povinné)
     *
     * @var int(11)
     */
    private $accountentrytypeId;

    /**
     * Typ DPH (povinné)
     *
     * @var int(11)
     */
    private $vattypeId;

    /**
     * Účet účetní osnovy
     *
     * @var int(11)
     */
    private $chartAccountId;

    /**
     * Účet DPH
     *
     * @var int(11)
     */
    private $vatChartId;

    /**
     * Středisko
     *
     * @var int(11)
     */
    private $departmentId;

    /**
     * Zakázka
     *
     * @var int(11)
     */
    private $contractId;

    /**
     * Příznak, zda je cena za kus zadaná včetně DPH
     * @var bool
     */
    private $unitPriceIncVat = false;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) {
            return;
        }
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->amount = Utils::getValueOrNull($arrayData, 'amount');
        $this->unit = Utils::getValueOrNull($arrayData, 'unit');
        $this->price = Utils::getValueOrNull($arrayData, 'price');
        $this->text = Utils::getValueOrNull($arrayData, 'text');
        $this->vat = Utils::getValueOrNull($arrayData, 'vat');
        $this->accountentrytypeId = Utils::getValueOrNull($arrayData, 'accountentrytype_id');
        $this->vattypeId = Utils::getValueOrNull($arrayData, 'vattype_id');
        $this->chartAccountId = Utils::getValueOrNull($arrayData, 'chart_account_id');
        $this->vatChartId = Utils::getValueOrNull($arrayData, 'vat_chart_id');
        $this->departmentId = Utils::getValueOrNull($arrayData, 'department_id');
        $this->contractId = Utils::getValueOrNull($arrayData, 'contract_id');
        $this->unitPriceIncVat = (bool)Utils::getValueOrNull($arrayData, 'unit_price_inc_vat');
    }

    public function toArray()
    {
        return array('id' => $this->id,
            'amount' => $this->amount,
            'unit' => $this->unit,
            'price' => $this->price,
            'text' => $this->text,
            'vat' => $this->vat,
            'accountentrytype_id' => $this->accountentrytypeId,
            'vattype_id' => $this->vattypeId,
            'chart_account_id' => $this->chartAccountId,
            'vat_chart_id' => $this->vatChartId,
            'department_id' => $this->departmentId,
            'contract_id' => $this->contractId,
            'unit_price_inc_vat' => $this->unitPriceIncVat);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getVat()
    {
        return $this->vat;
    }

    public function getAccountentrytypeId()
    {
        return $this->accountentrytypeId;
    }

    public function getVattypeId()
    {
        return $this->vattypeId;
    }

    public function getChartAccountId()
    {
        return $this->chartAccountId;
    }

    public function getVatChartId()
    {
        return $this->vatChartId;
    }

    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    public function getContractId()
    {
        return $this->contractId;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setVat($vat)
    {
        $this->vat = $vat;
    }

    public function setAccountentrytypeId($acountentrtypeId)
    {
        $this->accountentrytypeId = $acountentrtypeId;
    }

    public function setVattypeId($vattype)
    {
        $this->vattypeId = $vattype;
    }

    public function setChartAccountId($chartAccountId)
    {
        $this->chartAccountId = $chartAccountId;
    }

    public function setVatChartId($vatChartId)
    {
        $this->vatChartId = $vatChartId;
    }

    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
    }

    public function setContractId($contractId)
    {
        $this->contractId = $contractId;
    }

    /**
     * @return bool
     */
    public function getUnitPriceIncVat()
    {
        return $this->unitPriceIncVat;
    }

    /**
     * @param bool $unitPriceIncVat
     */
    public function setUnitPriceIncVat($unitPriceIncVat)
    {
        $this->unitPriceIncVat = $unitPriceIncVat;
    }


}
