<?php

namespace IUcto\Command;

/**
 * Description of SaveInventory
 *
 * @author iucto.cz
 */
class SaveInventory
{

    //** @var int */
    private $product_id;

    /** @var int */
    private $warehouse_id;

    /** @var float */
    private $initial_balance;

    /** @var float */
    private $minimal_balance;

    /** @var string */
    private $location;


    function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) {
            return;
        }

        $this->product_id = $arrayData['product_id'];
        $this->warehouse_id = $arrayData['warehouse_id'];
        $this->initial_balance = $arrayData['initial_balance'];
        $this->minimal_balance = $arrayData['minimal_balance'];
        $this->location = $arrayData['location'];
    }


    public function toArray()
    {
        return [
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'initial_balance' => $this->initial_balance,
            'minimal_balance' => $this->minimal_balance,
            'location' => $this->location,
        ];
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
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
    public function getInitialBalance()
    {
        return $this->initial_balance;
    }

    /**
     * @param float $initial_balance
     */
    public function setInitialBalance($initial_balance)
    {
        $this->initial_balance = $initial_balance;
    }

    /**
     * @return float
     */
    public function getMinimalBalance()
    {
        return $this->minimal_balance;
    }

    /**
     * @param float $minimal_balance
     */
    public function setMinimalBalance($minimal_balance)
    {
        $this->minimal_balance = $minimal_balance;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }
}
