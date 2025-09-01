<?php

namespace IUcto\Dto;

class Discount
{

    public const DISCOUNT_TYPE_PERCENT = 'percent';
    public const DISCOUNT_TYPE_AMOUNT = 'amount';

    /**
     * Typ slevy: percent | amount
     * @var null|string
     */
    private $discountType;

    /** @var null|float */
    private $discount;

    public function __construct(?string $discountType, ?float $discount)
    {
        $this->discountType = $discountType;
        $this->discount = $discount;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): void
    {
        $this->discount = $discount;
    }

    public function getDiscountType(): ?string
    {
        return $this->discountType;
    }

    public function setDiscountType(?string $discountType): void
    {
        $this->discountType = $discountType;
    }

}
