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
    public $doc_type;

    /** @var int */
    public $doc_id;

    /** @var string */
    public $doc_sequence_code;

    /** @var null|string */
    public $parent_sequence_code = null;

    /** @var string */
    public $date;

    /** @var string */
    public $date_vat;

    /** @var int */
    public $chartaccount_md;

    /** @var int */
    public $chartaccount_dal;

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
        $this->doc_type = Utils::getValueOrNull($arrayData, 'doc_type');
        $this->doc_id = Utils::getValueOrNull($arrayData, 'doc_id');
        $this->doc_sequence_code = Utils::getValueOrNull($arrayData, 'doc_sequence_code');
        $this->parent_sequence_code = Utils::getValueOrNull($arrayData, 'parent_sequence_code');
        $this->date = Utils::getValueOrNull($arrayData, 'date');
        $this->date_vat = Utils::getValueOrNull($arrayData, 'date_vat');
        $this->chartaccount_md = Utils::getValueOrNull($arrayData, 'chartaccount_md');
        $this->chartaccount_dal = Utils::getValueOrNull($arrayData, 'chartaccount_dal');
        $this->text = Utils::getValueOrNull($arrayData, 'text');
        $this->price = Utils::getValueOrNull($arrayData, 'price');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'doc_type' => $this->doc_type,
            'doc_id' => $this->doc_id,
            'doc_sequence_code' => $this->doc_sequence_code,
            'parent_sequence_code' => $this->parent_sequence_code,
            'date' => $this->date,
            'date_vat' => $this->date_vat,
            'chartaccount_md' => $this->chartaccount_md,
            'chartaccount_dal' => $this->chartaccount_dal,
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
        return $this->doc_type;
    }

    /**
     * @return int
     */
    public function getDocId()
    {
        return $this->doc_id;
    }

    /**
     * @return string
     */
    public function getDocSequenceCode()
    {
        return $this->doc_sequence_code;
    }

    /**
     * @return string|null
     */
    public function getParentSequenceCode()
    {
        return $this->parent_sequence_code;
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
        return $this->date_vat;
    }

    /**
     * @return int
     */
    public function getChartaccountMd()
    {
        return $this->chartaccount_md;
    }

    /**
     * @return int
     */
    public function getChartaccountDal()
    {
        return $this->chartaccount_dal;
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
