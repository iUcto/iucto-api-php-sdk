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

    /** @var float */
    private $real_amount;

    /** @var string */
    private $note;

    /** @var string */
    private $date;

    /** @var string */
    private $identification;

    function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) {
            return;
        }

        $this->product_id = $arrayData['product_id'];
        $this->warehouse_id = $arrayData['warehouse_id'];
        $this->amount = $arrayData['amount'];
        $this->real_amount = $arrayData['real_amount'];
        $this->note = $arrayData['note'];
        $this->date = $arrayData['date'];
        $this->identification = $arrayData['identification'];
    }


    public function toArray()
    {
        return [
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'amount' => $this->amount,
            'real_amount' => $this->real_amount,
            'note' => $this->note,
            'date' => $this->date,
            'identification' => $this->identification,
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
     * @return float
     */
    public function getRealAmount()
    {
        return $this->real_amount;
    }

    /**
     * @param float $real_amount
     */
    public function setRealAmount($real_amount)
    {
        $this->real_amount = $real_amount;
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

    /**
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * @param string $identification
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;
    }




}
