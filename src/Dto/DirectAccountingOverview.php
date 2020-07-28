<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for DocumentOverview data
 *
 * @author iucto.cz
 */
class DirectAccountingOverview
{

    /**
     * ID dokladu
     *
     * @var int(11)
     */
    protected $id;

    /**
     * Číslo dokladu
     *
     * @var string (45)
     */
    protected $sequenceCode;


    /**
     * Datum vystavení (YYYY-mm-dd)
     *
     * @var string
     */
    protected $date;


    /**
     * Měna dokladu
     *
     * @var string (3)
     */
    protected $currency;

    /**
     * Celková částka
     *
     * @var float
     */
    protected $amount;


    /**
     * Doklad je smazaný
     *
     * @var bool
     */
    protected $deleted;


    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->sequenceCode = Utils::getValueOrNull($arrayData, 'sequence_code');
        $this->date = Utils::getValueOrNull($arrayData, 'date');
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
        $this->amount = Utils::getValueOrNull($arrayData, 'amount');
        $this->deleted = Utils::getValueOrNull($arrayData, 'deleted');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSequenceCode()
    {
        return $this->sequenceCode;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted;
    }


}
