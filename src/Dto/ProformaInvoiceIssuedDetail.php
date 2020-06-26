<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for DocumentDetail data
 *
 * @author iucto.cz
 */
class ProformaInvoiceIssuedDetail extends ProformaInvoiceIssuedOverview
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
     * @var Customer
     */
    private $customer;

    /**
     * Bankovní účet zákazníka
     *
     * @var string (45)
     */
    protected $customerBankAccount;

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
        if (array_key_exists('customer', $arrayData)) {
            $this->customer = new Customer($arrayData['customer']);
            unset($arrayData['customer']);
        }

        parent::__construct($arrayData);

        $this->price = Utils::getValueOrNull($arrayData, 'price');
        $this->priceCzk = Utils::getValueOrNull($arrayData, 'price_czk');
        $this->priceIncVatCzk = Utils::getValueOrNull($arrayData, 'price_inc_vat_czk');
        $this->customerBankAccount = Utils::getValueOrNull($arrayData, 'customer_bank_account');
        $this->paymentType = Utils::getValueOrNull($arrayData, 'payment_type');
        if (isset($arrayData['bank_account']) && !empty($arrayData['bank_account'])) {
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

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    public function getCustomerBankAccount()
    {
        return $this->customerBankAccount;
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
}
