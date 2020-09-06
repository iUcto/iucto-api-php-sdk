<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for DirectAccountingItemBase data
 *
 * @author iucto.cz
 */
class DirectAccountingItemBase
{

    /**
     * ID položky
     *
     * @var int(11)
     */
    protected $id;

    /**
     * Cena (povinné)
     *
     * @var float(12,2)
     */
    protected $price;

    /**
     * Popis (povinné)
     *
     * @var string(255)
     */
    protected $text;


    /**
     * Účet účetní osnovy MD (povinné)
     *
     * @var int(11)
     */
    protected $chartAccountMd;

    /**
     * Účet účetní osnovy DAL (povinné)
     *
     * @var int(11)
     */
    protected $chartAccountDal;


    /**
     * Středisko
     *
     * @var int|null
     */
    protected $departmentId;

    /**
     * Zakázka
     *
     * @var int|null
     */
    protected $contractId;

    /**
     * Párovací znak
     *
     * @var string|null
     */
    protected $daCode;

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
        $this->price = Utils::getValueOrNull($arrayData, 'price');
        $this->text = Utils::getValueOrNull($arrayData, 'text');
        $this->chartAccountMd = Utils::getValueOrNull($arrayData, 'chartaccount_md');
        $this->chartAccountDal = Utils::getValueOrNull($arrayData, 'chartaccount_dal');
        $this->departmentId = Utils::getValueOrNull($arrayData, 'department_id');
        $this->contractId = Utils::getValueOrNull($arrayData, 'contract_id');
        $this->daCode = Utils::getValueOrNull($arrayData, 'da_code');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getChartAccountMd()
    {
        return $this->chartAccountMd;
    }

    /**
     * @param int $chartAccountMd
     */
    public function setChartAccountMd($chartAccountMd)
    {
        $this->chartAccountMd = $chartAccountMd;
    }

    /**
     * @return int
     */
    public function getChartAccountDal()
    {
        return $this->chartAccountDal;
    }

    /**
     * @param int $chartAccountDal
     */
    public function setChartAccountDal($chartAccountDal)
    {
        $this->chartAccountDal = $chartAccountDal;
    }

    /**
     * @return int|null
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * @param int|null $departmentId
     */
    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
    }

    /**
     * @return int|null
     */
    public function getContractId()
    {
        return $this->contractId;
    }

    /**
     * @param int|null $contractId
     */
    public function setContractId($contractId)
    {
        $this->contractId = $contractId;
    }

    /**
     * @return string|null
     */
    public function getDaCode()
    {
        return $this->daCode;
    }

    /**
     * @param string|null $daCode
     */
    public function setDaCode($daCode)
    {
        $this->daCode = $daCode;
    }


}
