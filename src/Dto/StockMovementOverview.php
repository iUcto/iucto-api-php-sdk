<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for StockMovementDetail data
 *
 * @author iucto.cz
 */
class StockMovementOverview extends RawData
{
    /** @var int */
    protected $id;

    /** @var int */
    protected $product_id;

    /** @var int */
    protected $warehouse_id;

    /** @var float */
    protected $amount;

    /** @var string */
    protected $note;

    /** @var string */
    protected $date;

    /** @var string */
    protected $identification;


    /**
     * @param array<string, string|null> $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);
        if (empty($arrayData)) return;

        $this->id = Utils::getTypedValueOrNull($arrayData, 'id', Utils::TYPE_INT);
        $this->product_id = Utils::getTypedValueOrNull($arrayData, 'product_id', Utils::TYPE_INT);
        $this->warehouse_id = Utils::getTypedValueOrNull($arrayData, 'warehouse_id', Utils::TYPE_INT) ?? Utils::getTypedValueOrNull($arrayData, 'inventory_id', Utils::TYPE_INT);
        $this->amount = Utils::getTypedValueOrNull($arrayData, 'amount', Utils::TYPE_FLOAT) ?? 0.0;
        $this->note = Utils::getValueOrNull($arrayData, 'note');
        $this->date = Utils::getValueOrNull($arrayData, 'date');
        $this->identification = Utils::getValueOrNull($arrayData, 'identification');
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function getWarehouseId(): ?int
    {
        return $this->warehouse_id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getIdentification(): ?string
    {
        return $this->identification;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'amount' => $this->amount,
            'note' => $this->note,
            'date' => $this->date,
            'identification' => $this->identification,
        ];
    }

}
