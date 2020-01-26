<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for StockMovementDetail data
 *
 * @author iucto.cz
 */
class StockMovementDetail
{
    /** @var int */
    private $product_id;

    /** @var int */
    private $warehouse_id;

    /** @var float */
    private $amount;

    /** @var string */
    private $note;

    /** @var string */
    private $date;

    /** @var string */
    private $identification;


    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) return;

        $this->product_id = Utils::getValueOrNull($arrayData, 'product_id');
        $this->warehouse_id = Utils::getValueOrNull($arrayData, 'warehouse_id');
        $this->amount = Utils::getValueOrNull($arrayData, 'amount');
        $this->note = Utils::getValueOrNull($arrayData, 'note');
        $this->date = Utils::getValueOrNull($arrayData, 'date');
        $this->identification = Utils::getValueOrNull($arrayData, 'identification');
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @return int
     */
    public function getWarehouseId()
    {
        return $this->warehouse_id;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
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
    public function getIdentification()
    {
        return $this->identification;
    }


    public function toArray()
    {
        return [
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'amount' => $this->amount,
            'note' => $this->note,
            'date' => $this->date,
            'identification' => $this->identification,
        ];
    }

}
