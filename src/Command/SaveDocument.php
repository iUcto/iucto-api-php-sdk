<?php

namespace IUcto\Command;

use IUcto\Utils;
use IUcto\Dto\DocumentItem;
/**
 * Comman object pro uložení dokumentu
 *
 * @author admin
 */
class SaveDocument {

    /**
     * Variabilní symbol (povinné)
     *   
     * @var string (42)
     */
    private $variableSymbol;

    /**
     * Datum vystavení (povinné)
     *   
     * @var DateTime
     */
    private $date;

    /**
     * Datum zdanitelného plnění (povinné)
     *   
     * @var DateTime
     */
    private $dateVat;

    /**
     * Datum splatnosti (povinné)
     *   
     * @var DateTime
     */
    private $maturityDate;

    /**
     * Měna dokladu (povinné)
     *   
     * @var string (3)
     */
    private $currency;

    /**
     * Zákazník (povinné)
     *   
     * @var CustomerOverview
     */
    private $customerId;

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
     * Bankovního účet pro příjem platby (povinné)
     *   
     * @var int
     */
    private $bankAccount;

    /**
     * Datum zdanitelného plnění
     *   
     * @var DateTime
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
     * Položky dokladu (povinné)
     *   
     * @var DocumentItem[]
     */
    private $items = array();

    public function __construct(array $dataArray = array()) {
        $this->variableSymbol = Utils::getValueOrNull($dataArray, 'variable_symbol');
        $this->date = Utils::getDateTimeFrom($dataArray['date']);
        $this->dateVat = Utils::getDateTimeFrom($dataArray['date_vat']);
        $this->maturityDate = Utils::getDateTimeFrom($dataArray['maturity_date']);
        $this->currency = Utils::getValueOrNull($dataArray, 'currency');
        $this->customerId = Utils::getValueOrNull($dataArray, 'customer_id');
        $this->customerBankAccount = Utils::getValueOrNull($dataArray, 'customer_bank_account');
        $this->paymentType = Utils::getValueOrNull($dataArray, 'payment_type');
        $this->bankAccount = Utils::getValueOrNull($dataArray, 'bank_account');
        $this->dateVatPrev = Utils::getDateTimeFrom($dataArray['date_vat_prev']);
        $this->description = Utils::getValueOrNull($dataArray, 'description');
        $this->roundingType = Utils::getValueOrNull($dataArray, 'rounding_type');
        if (array_key_exists('items', $dataArray)) {
            foreach ($dataArray['items'] as $itemData) {
                $this->items[] = new DocumentItem($itemData);
            }
        }
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

    public function getCustomerId() {
        return $this->customerId;
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

    public function setVariableSymbol($variableSymbol) {
        $this->variableSymbol = $variableSymbol;
    }

    /**
     * 
     * @param int|DateTime $input unix timestamp or DateTime object
     */
    public function setDate($input) {
        $this->date = Utils::getDateTimeFrom($input);
    }

    /**
     * 
     * @param int|DateTime $input unix timestamp or DateTime object
     */
    public function setDateVat($input) {
        $this->dateVat = Utils::getDateTimeFrom($input);
    }

    /**
     * 
     * @param int|DateTime $input unix timestamp or DateTime object
     */
    public function setMaturityDate($input) {
        $this->maturityDate = Utils::getDateTimeFrom($input);
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    public function setCustomerId($customerId) {
        $this->customerId = $customerId;
    }

    public function setCustomerBankAccount($customerBankAccount) {
        $this->customerBankAccount = $customerBankAccount;
    }

    public function setPaymentType($paymentType) {
        $this->paymentType = $paymentType;
    }

    public function setBankAccount(BankAccount $bankAccount) {
        $this->bankAccount = $bankAccount;
    }

    /**
     * 
     * @param int|DateTime $input unix timestamp or DateTime object
     */
    public function setDateVatPrev($input) {
        $this->dateVatPrev = Utils::getDateTimeFrom($input);
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setRoundingType($roundingType) {
        $this->roundingType = $roundingType;
    }

    public function setItems(array $items) {
        $this->items = $items;
    }

    public function toArray() {
        $array = array('variable_symbol' => $this->variableSymbol,
            'date' => Utils::getTimestampFrom($this->date),
            'date_vat' => Utils::getTimestampFrom($this->dateVat),
            'maturity_date' => Utils::getTimestampFrom($this->maturityDate),
            'currency' => $this->currency,
            'customer_id' => $this->customerId,
            'customer_bank_account' => $this->customerBankAccount,
            'payment_type' => $this->paymentType,
            'bank_account' => $this->bankAccount,
            'date_vat_prev' => Utils::getTimestampFrom($this->dateVatPrev),
            'description' => $this->description,
            'rounding_type' => $this->roundingType
        );
        $array['items'] = array();
        foreach ($this->items as $item) {
            $array['items'][] = $item->toArray();
        }
        return $array;
    }

}
