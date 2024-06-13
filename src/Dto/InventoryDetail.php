<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for ProductDetail data
 *
 * @author iucto.cz
 */
class InventoryDetail extends RawData
{

    private $id;
    private $product_id;
    private $warehouse_id;
    private $initial_balance;
    private $minimal_balance;
    private $balance;
    private $location;
    private $is_deleted;
    private $date_last_movement;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);
        if (empty($arrayData)) return;

        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->product_id = Utils::getValueOrNull($arrayData, 'product_id');
        $this->warehouse_id = Utils::getValueOrNull($arrayData, 'warehouse_id');
        $this->initial_balance = Utils::getValueOrNull($arrayData, 'initial_balance');
        $this->minimal_balance = Utils::getValueOrNull($arrayData, 'minimal_balance');
        $this->balance = Utils::getValueOrNull($arrayData, 'balance');
        $this->location = Utils::getValueOrNull($arrayData, 'location');
        $this->is_deleted = Utils::getValueOrNull($arrayData, 'is_deleted');
        $this->date_last_movement = Utils::getValueOrNull($arrayData, 'date_last_movement');
    }

    /**
     * @return mixed|null
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @return mixed|null
     */
    public function getWarehouseId()
    {
        return $this->warehouse_id;
    }

    /**
     * @return mixed|null
     */
    public function getInitialBalance()
    {
        return $this->initial_balance;
    }

    /**
     * @return mixed|null
     */
    public function getMinimalBalance()
    {
        return $this->minimal_balance;
    }

    /**
     * @return mixed|null
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @return mixed|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed|null
     */
    public function isDeleted()
    {
        return $this->is_deleted;
    }

    /**
     * @return mixed|null
     */
    public function getDateLastMovement()
    {
        return $this->date_last_movement;
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->id;
    }



    public function toArray()
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'initial_balance' => $this->initial_balance,
            'minimal_balance' => $this->minimal_balance,
            'balance' => $this->balance,
            'location' => $this->location,
            'is_deleted' => $this->is_deleted,
            'date_last_movement' => $this->date_last_movement,
        ];
    }

}
