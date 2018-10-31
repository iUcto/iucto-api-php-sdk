<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for OrderIssuedDetail data
 *
 * @author iucto.cz
 */
class OrderReceivedDetail
{

    /**
     * ID dokladu
     *
     * @var int(11)
     */
    private $id;

    /**
     * Číslo dokladu
     *
     * @var string (45)
     */
    private $sequenceCode;

    /**
     * Datum vystavení (formát YYYY-mm-dd)
     *
     * @var string
     */
    private $date;

    /**
     * Měna dokladu
     *
     * @var string (3)
     */
    private $currency;

    /**
     * Celková částka bez DPH
     *
     * @var int(11)
     */
    private $price;

    /**
     * Celková částka v CZK bez DPH
     *
     * @var int(11)
     */
    private $priceCzk;

    /**
     * Celková částka s DPH
     *
     * @var int(11)
     */
    private $priceIncVat;

    /**
     * Celková částka v CZK s DPH
     *
     * @var int(11)
     */
    private $priceIncVatCzk;

    /**
     * Dodavatel
     *
     * @var CustomerOverview
     */
    private $customer;

    /**
     * Poznámka
     *
     * @var string
     */
    private $description;

    /**
     * Způsob zaokrouhlení
     *
     * @var string
     */
    private $roundingType;

    /**
     * ID spárované faktury vydaná
     *
     * @var int|null
     */
    private $invoiceId;

    /**
     * Položky dokladu
     *
     * @var DocumentItem[]
     */
    private $items = array();

    /**
     * Doklad je smazaný
     *
     * @var bool
     */
    private $deleted;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->sequenceCode = Utils::getValueOrNull($arrayData, 'sequence_code');
        $this->date = Utils::getDateTimeFrom($arrayData['date']);
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
        $this->price = Utils::getValueOrNull($arrayData, 'price');
        $this->priceCzk = Utils::getValueOrNull($arrayData, 'price_czk');
        $this->priceIncVat = Utils::getValueOrNull($arrayData, 'price_inc_vat');
        $this->priceIncVatCzk = Utils::getValueOrNull($arrayData, 'price_inc_vat_czk');
        if (array_key_exists('customer', $arrayData)) {
            $this->customer = new CustomerOverview($arrayData['customer']);
        }
        $this->description = Utils::getValueOrNull($arrayData, 'description');
        $this->roundingType = Utils::getValueOrNull($arrayData, 'rounding_type');
        $this->invoiceId = Utils::getValueOrNull($arrayData, 'invoice_id');
        if (array_key_exists('items', $arrayData)) {
            foreach ($arrayData['items'] as $itemData) {
                $this->items[] = new DocumentItem($itemData);
            }
        }
        $this->deleted = Utils::getValueOrNull($arrayData, 'deleted');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSequenceCode()
    {
        return $this->sequenceCode;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getPriceCzk()
    {
        return $this->priceCzk;
    }

    public function getPriceIncVat()
    {
        return $this->priceIncVat;
    }

    public function getPriceIncVatCzk()
    {
        return $this->priceIncVatCzk;
    }


    public function getCustomer()
    {
        return $this->customer;
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

    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

}
