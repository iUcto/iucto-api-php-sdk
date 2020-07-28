<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for DocumentDetail data
 *
 * @author iucto.cz
 */
class DirectAccountingDetail extends DirectAccountingOverview
{
    /**
     * Celková částka v CZK
     *
     * @var float
     */
    private $amountCzk;

    /**
     * Poznámka
     *
     * @var string|null
     */
    private $description;


    /**
     * Interní poznámka
     *
     * @var string|null
     */
    private $descriptionInternal;


    /**
     * Položky dokladu
     *
     * @var DirectAccountingItemDetail[]
     */
    private $items = array();

    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);

        $this->amountCzk = Utils::getValueOrNull($arrayData, 'amount_czk');
        $this->description = Utils::getValueOrNull($arrayData, 'description');
        $this->descriptionInternal = Utils::getValueOrNull($arrayData, 'description_internal');

        if (array_key_exists('items', $arrayData)) {
            foreach ($arrayData['items'] as $itemData) {
                $this->items[] = new DirectAccountingItemDetail($itemData);
            }
        }
    }

    /**
     * @return float
     */
    public function getAmountCzk()
    {
        return $this->amountCzk;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getDescriptionInternal()
    {
        return $this->descriptionInternal;
    }

    /**
     * @return DirectAccountingItemDetail[]
     */
    public function getItems()
    {
        return $this->items;
    }


}
