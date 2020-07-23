<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for StockMovementDetail data
 *
 * @author iucto.cz
 */
class StockMovementDetail extends StockMovementOverview
{
    /** @var float */
    private $real_amount;


    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);

        if (empty($arrayData)) return;

        $this->real_amount = Utils::getValueOrNull($arrayData, 'real_amount');
    }


    public function toArray()
    {
        $array = parent::toArray();
        return $array + [
                'real_amount' => $this->real_amount,
            ];
    }

}
