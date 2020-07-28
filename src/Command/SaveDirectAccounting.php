<?php

namespace IUcto\Command;

use IUcto\Dto\DirectAccountingItemSave;
use IUcto\Utils;

/**
 * Command object pro uložení dokumentu
 *
 * @author iucto.cz
 */
class SaveDirectAccounting
{


    /**
     * Číslo dokladu
     * @var string (45)
     */
    private $sequenceCode;

    /**
     * Datum vystavení (povinné) (formát YYYY-mm-dd)
     *
     * @var string
     */
    private $date;

    /**
     * Měna dokladu (povinné)
     * @see \IUcto\IUcto::getCurrencies()
     *
     * @var string (3)
     */
    private $currency;

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
     * Položky dokladu (povinné)
     *
     * @var DirectAccountingItemSave[]
     */
    private $items = array();

    public function __construct(array $dataArray = [])
    {
        if (empty($dataArray)) {
            return;
        }


        $this->sequenceCode = Utils::getValueOrNull($dataArray, 'sequence_code');
        $this->date = Utils::getValueOrNull($dataArray, 'date');
        $this->currency = Utils::getValueOrNull($dataArray, 'currency');
        $this->description = Utils::getValueOrNull($dataArray, 'description');
        $this->descriptionInternal = Utils::getValueOrNull($dataArray, 'description_internal');
        if (array_key_exists('items', $dataArray)) {
            foreach ($dataArray['items'] as $itemData) {
                $this->items[] = new DirectAccountingItemSave($itemData);
            }
        }
    }

    public function toArray()
    {
        $array = [
            'sequence_code' => $this->sequenceCode,
            'date' => $this->date,
            'currency' => $this->currency,
            'description' => $this->description,
            'description_internal' => $this->descriptionInternal,
        ];
        $array['items'] = array();
        foreach ($this->items as $item) {
            $array['items'][] = $item->toArray();
        }
        return $array;
    }

    /**
     * @return string
     */
    public function getSequenceCode()
    {
        return $this->sequenceCode;
    }

    /**
     * @param string $sequenceCode
     */
    public function setSequenceCode($sequenceCode)
    {
        $this->sequenceCode = $sequenceCode;
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
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getDescriptionInternal()
    {
        return $this->descriptionInternal;
    }

    /**
     * @param string|null $descriptionInternal
     */
    public function setDescriptionInternal($descriptionInternal)
    {
        $this->descriptionInternal = $descriptionInternal;
    }

    /**
     * @return DirectAccountingItemSave[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param DirectAccountingItemSave[] $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }


}
