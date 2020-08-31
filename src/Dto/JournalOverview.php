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
    protected $id;

    /** @var string */
    protected $documentType;

    /** @var int */
    protected $documentId;

    /** @var string */
    protected $documentSequenceCode;

    /** @var null|string */
    protected $parentDocumentSequenceCode = null;

    /** @var string */
    protected $date;

    /** @var string */
    protected $dateVat;

    /** @var int */
    protected $chartaccountMd;

    /** @var int */
    protected $chartaccountDal;

    /** @var string */
    protected $text;

    /** @var float */
    protected $price;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) return;

        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->documentType = Utils::getValueOrNull($arrayData, 'document_type');
        $this->documentId = Utils::getValueOrNull($arrayData, 'document_id');
        $this->documentSequenceCode = Utils::getValueOrNull($arrayData, 'document_sequence_code');
        $this->parentDocumentSequenceCode = Utils::getValueOrNull($arrayData, 'parent_document_sequence_code');
        $this->date = Utils::getValueOrNull($arrayData, 'date');
        $this->dateVat = Utils::getValueOrNull($arrayData, 'date_vat');
        $this->chartaccountMd = Utils::getValueOrNull($arrayData, 'chartaccount_md');
        $this->chartaccountDal = Utils::getValueOrNull($arrayData, 'chartaccount_dal');
        $this->text = Utils::getValueOrNull($arrayData, 'text');
        $this->price = Utils::getValueOrNull($arrayData, 'price');
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
    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * @return int
     */
    public function getDocumentId()
    {
        return $this->documentId;
    }

    /**
     * @return string
     */
    public function getDocumentSequenceCode()
    {
        return $this->documentSequenceCode;
    }

    /**
     * @return string|null
     */
    public function getParentDocumentSequenceCode()
    {
        return $this->parentDocumentSequenceCode;
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
