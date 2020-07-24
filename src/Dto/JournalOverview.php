<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for Journal data
 *
 * @author iucto.cz
 */
class JournalOverview
{
    /** @var int */
    public $id;

    /** @var string */
    public $docType;

    /** @var int */
    public $docId;

    /** @var string */
    public $docSequenceCode;

    /** @var null|string */
    public $parentSequenceCode = null;

    /** @var string */
    public $date;

    /** @var string */
    public $dateVat;

    /** @var int */
    public $chartaccountMd;

    /** @var int */
    public $chartaccountDal;

    /** @var string */
    public $text;

    /** @var float */
    public $price;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) return;

        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->docType = Utils::getValueOrNull($arrayData, 'document_type');
        $this->docId = Utils::getValueOrNull($arrayData, 'document_id');
        $this->docSequenceCode = Utils::getValueOrNull($arrayData, 'document_sequence_code');
        $this->parentSequenceCode = Utils::getValueOrNull($arrayData, 'parent_document_sequence_code');
        $this->date = Utils::getValueOrNull($arrayData, 'date');
        $this->dateVat = Utils::getValueOrNull($arrayData, 'date_vat');
        $this->chartaccountMd = Utils::getValueOrNull($arrayData, 'chartaccount_md');
        $this->chartaccountDal = Utils::getValueOrNull($arrayData, 'chartaccount_dal');
        $this->text = Utils::getValueOrNull($arrayData, 'text');
        $this->price = Utils::getValueOrNull($arrayData, 'price');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'document_type' => $this->docType,
            'document_id' => $this->docId,
            'document_sequence_code' => $this->docSequenceCode,
            'parent_document_sequence_code' => $this->parentSequenceCode,
            'date' => $this->date,
            'date_vat' => $this->dateVat,
            'chartaccount_md' => $this->chartaccountMd,
            'chartaccount_dal' => $this->chartaccountDal,
            'text' => $this->text,
            'price' => $this->price,
        ];
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
    public function getDocType()
    {
        return $this->docType;
    }

    /**
     * @return int
     */
    public function getDocId()
    {
        return $this->docId;
    }

    /**
     * @return string
     */
    public function getDocSequenceCode()
    {
        return $this->docSequenceCode;
    }

    /**
     * @return string|null
     */
    public function getParentSequenceCode()
    {
        return $this->parentSequenceCode;
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
    public function getDateVat()
    {
        return $this->dateVat;
    }

    /**
     * @return int
     */
    public function getChartaccountMd()
    {
        return $this->chartaccountMd;
    }

    /**
     * @return int
     */
    public function getChartaccountDal()
    {
        return $this->chartaccountDal;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }


}
