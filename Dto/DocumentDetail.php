<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentDetail
 *
 * @author admin
 */
class DocumentDetail {

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
     * Variabilní symbol
     *   
     * @var string (42)
     */
    private $variableSymbol;

    /**
     * Datum vystavení
     *   
     * @var \DateTime
     */
    private $date;

    /**
     * Datum zdanitelného plnění
     *   
     * @var \DateTime
     */
    private $dateVat;

    /**
     * Datum splatnosti
     *   
     * @var \DateTime
     */
    private $maturityDate;

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
     * Zbývající částka k úhradě (v měně dokladu)
     *   
     * @var int
     */
    private $toBePaid;

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
    private $customerBankAccount;

    /**
     * Forma úhrady
     *   
     * @var int(1)
     */
    private $paymentType;

    /**
     * Bankovního účet pro příjem platby
     *   
     * @var BankAccount
     */
    private $bankAccount;

    /**
     * Datum zdanitelného plnění
     *   
     * @var \DateTime
     */
    private $dateVatPrev;

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
     * Položky dokladu
     *   
     * @var DocumentItem[]
     */
    private $items = array();

    /**
     * Doklad je zaúčtován
     *   
     * @var bool
     */
    private $accounted;

    /**
     * Doklad je smazaný
     *   
     * @var bool
     */
    private $deleted;

    public function __construct(array $dataArray) {
        $this->id = ArrayUtils::getValueOrNull($dataArray, 'id');
        $this->sequenceCode = ArrayUtils::getValueOrNull($dataArray, 'sequence_code');
        $this->variableSymbol = ArrayUtils::getValueOrNull($dataArray, 'variable_symbol');
        $this->date = ArrayUtils::getValueOrNull($dataArray, 'date');
        $this->dateVat = ArrayUtils::getValueOrNull($dataArray, 'date_vat');
        $this->maturityDate = ArrayUtils::getValueOrNull($dataArray, 'maturity_date');
        $this->currency = ArrayUtils::getValueOrNull($dataArray, 'currency');
        $this->price = ArrayUtils::getValueOrNull($dataArray, 'price');
        $this->priceCzk = ArrayUtils::getValueOrNull($dataArray, 'price_czk');
        $this->priceIncVat = ArrayUtils::getValueOrNull($dataArray, 'price_inc_vat');
        $this->priceIncVatCzk = ArrayUtils::getValueOrNull($dataArray, 'price_inc_vat_czk');
        $this->toBePaid = ArrayUtils::getValueOrNull($dataArray, 'to_be_paid');
        if (array_key_exists('customer', $dataArray)) {
            $this->customer = new Customer($dataArray['customer']);
        }
        $this->customerBankAccount = ArrayUtils::getValueOrNull($dataArray, 'customer_bank_account');
        $this->paymentType = ArrayUtils::getValueOrNull($dataArray, 'payment_type');
        if (array_key_exists('bank_account', $dataArray)) {
            $this->bankAccount = new BankAccount($dataArray['bank_account']);
        }
        
        $this->dateVatPrev = ArrayUtils::getValueOrNull($dataArray, 'date_vat_prev');
        $this->description = ArrayUtils::getValueOrNull($dataArray, 'description');
        $this->roundingType = ArrayUtils::getValueOrNull($dataArray, 'rounding_type');
        if (array_key_exists('items', $dataArray)) {
            foreach ($dataArray['items'] as $itemData) {
                $this->items[] = new DocumentItem($itemData);
            }
        }        
        $this->accounted = ArrayUtils::getValueOrNull($dataArray, 'accounted');
        $this->deleted = ArrayUtils::getValueOrNull($dataArray, 'deleted');
    }

    public function getId() {
        return $this->id;
    }

    public function getSequenceCode() {
        return $this->sequenceCode;
    }

    public function getVariableSymbol() {
        return $this->variableSymbol;
    }

    public function getDate() {
        return $this->date;
    }

    public function getDateVat() {
        return $this->dateVat;
    }

    public function getMaturityDate() {
        return $this->maturityDate;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getPriceCzk() {
        return $this->priceCzk;
    }

    public function getPriceIncVat() {
        return $this->priceIncVat;
    }

    public function getPriceIncVatCzk() {
        return $this->priceIncVatCzk;
    }

    public function getToBePaid() {
        return $this->toBePaid;
    }

    public function getCustomer() {
        return $this->customer;
    }

    public function getCustomerBankAccount() {
        return $this->customerBankAccount;
    }

    public function getPaymentType() {
        return $this->paymentType;
    }

    public function getBankAccount() {
        return $this->bankAccount;
    }

    public function getDateVatPrev() {
        return $this->dateVatPrev;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getRoundingType() {
        return $this->roundingType;
    }

    public function getItems() {
        return $this->items;
    }

    public function getAccounted() {
        return $this->accounted;
    }

    public function getDeleted() {
        return $this->deleted;
    }

}
