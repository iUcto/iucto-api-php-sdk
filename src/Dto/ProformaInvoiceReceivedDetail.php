<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for ProformaInvoiceReceivedDetail data
 *
 * @author iucto.cz
 */
class ProformaInvoiceReceivedDetail extends ProformaInvoiceReceivedOverview
{

    /**
     * Celková částka bez DPH
     *
     * @var int(11)
     */
    protected $price;

    /**
     * Celková částka v CZK bez DPH
     *
     * @var int(11)
     */
    protected $priceCzk;


    /**
     * Celková částka v CZK s DPH
     *
     * @var int(11)
     */
    protected $priceIncVatCzk;


    /**
     * Zákazník
     *
     * @var Supplier
     */
    private $supplier;


    /**
     * Forma úhrady
     *
     * @var string
     */
    protected $paymentType;

    /**
     * Bankovního účet pro příjem platby
     *
     * @var BankAccount
     */
    protected $bankAccount;

    /**
     * Datum zdanitelného plnění
     *
     * @var string
     */
    protected $dateVatPrev;

    /**
     * Poznámka
     *
     * @var string
     */
    protected $description;

    /**
     * Způsob zaokrouhlení
     *
     * @var string
     */
    protected $roundingType;

    /**
     * Položky dokladu
     *
     * @var DocumentItem[]
     */
    protected $items = array();

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        if (array_key_exists('supplier', $arrayData)) {
            $this->supplier = new Supplier($arrayData['supplier']);
            unset($arrayData['supplier']);
        }

        parent::__construct($arrayData);

        $this->price = Utils::getValueOrNull($arrayData, 'price');
        $this->priceCzk = Utils::getValueOrNull($arrayData, 'price_czk');
        $this->priceIncVatCzk = Utils::getValueOrNull($arrayData, 'price_inc_vat_czk');
        $this->paymentType = Utils::getValueOrNull($arrayData, 'payment_type');
        if (array_key_exists('bank_account', $arrayData)) {
            $this->bankAccount = new BankAccount($arrayData['bank_account']);
        }
        $this->dateVatPrev = Utils::getDateTimeFrom($arrayData['date_vat_prev']);
        $this->description = Utils::getValueOrNull($arrayData, 'description');
        $this->roundingType = Utils::getValueOrNull($arrayData, 'rounding_type');
        if (array_key_exists('items', $arrayData)) {
            foreach ($arrayData['items'] as $itemData) {
                $this->items[] = new DocumentItem($itemData);
            }
        }
    }


    public function getPrice()
    {
        return $this->price;
    }

    public function getPriceCzk()
    {
        return $this->priceCzk;
    }

    public function getPriceIncVatCzk()
    {
        return $this->priceIncVatCzk;
    }

    public function getPaymentType()
    {
        return $this->paymentType;
    }

    public function getBankAccount()
    {
        return $this->bankAccount;
    }

    public function getDateVatPrev()
    {
        return $this->dateVatPrev;
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
     * @return Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

}
