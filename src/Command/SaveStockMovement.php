<?php

namespace IUcto\Command;

/**
 * Description of SaveStockMovement
 *
 * @author iucto.cz
 */
class SaveStockMovement
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

    function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) {
            return;
        }

        $this->product_id = $arrayData['product_id'];
        $this->warehouse_id = $arrayData['warehouse_id'];
        $this->amount = $arrayData['amount'];
        $this->note = $arrayData['note'];
        $this->date = $arrayData['date'];
    }


    public function toArray()
    {
        return [
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'amount' => $this->amount,
            'note' => $this->note,
            'date' => $this->date,
        ];
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param int $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return int
     */
    public function getWarehouseId()
    {
        return $this->warehouse_id;
    }

    /**
     * @param int $warehouse_id
     */
    public function setWarehouseId($warehouse_id)
    {
        $this->warehouse_id = $warehouse_id;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}
