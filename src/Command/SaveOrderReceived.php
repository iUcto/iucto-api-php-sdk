<?php

namespace IUcto\Command;

use IUcto\Dto\DocumentItem;
use IUcto\Dto\InvoiceIsseudOverview;
use IUcto\Utils;

/**
 * Comman object pro uložení dokumentu
 *
 * @author iucto.cz
 */
class SaveOrderReceived
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
     * Zákazník (povinné)
     * @see \IUcto\IUcto::getCustomers()
     *
     * @var int
     */
    private $customerId;

    /**
     * Poznámka
     *
     * @var string
     */
    private $description;

    /**
     * Způsob zaokrouhlení
     *
     * @see \IUcto\IUcto::getRoundingTypes()
     *
     * @var string
     */
    private $roundingType;

    /**
     * Položky dokladu (povinné)
     *
     * @var DocumentItem[]
     */
    private $items = array();

    /**
     * @see \IUcto\IUcto::getAllInvoiceIssued()
     *
     * @var InvoiceIsseudOverview
     */
    private $invoiceId;

    public function __construct(array $dataArray = [])
    {
        if (empty($dataArray)) {
            return;
        }

        $this->sequenceCode = Utils::getValueOrNull($dataArray, 'sequence_code');
        $this->date = Utils::getValueOrNull($dataArray, 'date');
        $this->currency = Utils::getValueOrNull($dataArray, 'currency');
        $this->customerId = Utils::getValueOrNull($dataArray, 'customer_id');
        $this->description = Utils::getValueOrNull($dataArray, 'description');
        $this->roundingType = Utils::getValueOrNull($dataArray, 'rounding_type');
        $this->invoiceId = Utils::getValueOrNull($dataArray, 'invoice_id');
        if (array_key_exists('items', $dataArray)) {
            foreach ($dataArray['items'] as $itemData) {
                $this->items[] = new DocumentItem($itemData);
            }
        }
    }


    public function getDate()
    {
        return $this->date;
    }


    public function getCurrency()
    {
        return $this->currency;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getRoundingType()
    {
        return $this->roundingType;
    }

    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return InvoiceIsseudOverview
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }


    /**
     *
     * @param int|\DateTime $input unix timestamp or DateTime object
     */
    public function setDate($input)
    {
        $this->date = Utils::getDateTimeFrom($input)->format('Y-m-d');
    }


    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setRoundingType($roundingType)
    {
        $this->roundingType = $roundingType;
    }

    public function setItems(array $items)
    {
        $this->items = $items;
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
     * @param InvoiceIsseudOverview $invoiceId
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = array(
            'sequence_code' => $this->sequenceCode,
            'date' => $this->date,
            'currency' => $this->currency,
            'customer_id' => $this->customerId,
            'description' => $this->description,
            'rounding_type' => $this->roundingType,
            'invoice_id' => $this->invoiceId,
        );
        $array['items'] = array();
        foreach ($this->items as $item) {
            $array['items'][] = $item->toArray();
        }
        return $array;
    }

}
