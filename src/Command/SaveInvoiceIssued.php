<?php

namespace IUcto\Command;

use IUcto\Dto\DocumentItem;
use IUcto\Utils;

/**
 * Comman object pro uložení dokumentu
 *
 * @author iucto.cz
 */
class SaveInvoiceIssued
{

    /**
     * Variabilní symbol (povinné)
     *
     * @var string (42)
     */
    private $variableSymbol;

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
     * Datum zdanitelného plnění (povinné) (formát YYYY-mm-dd)
     *
     * @var string
     */
    private $dateVat;

    /**
     * Datum splatnosti (povinné) (formát YYYY-mm-dd)
     *
     * @var string
     */
    private $maturityDate;

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
     * Bankovní účet zákazníka
     *
     * @var string (45)
     */
    private $customerBankAccount;

    /**
     * Forma úhrady
     * @see \IUcto\IUcto::getPaymentTypes()
     *
     * @var int(1)
     */
    private $paymentType;

    /**
     * Bankovního účet pro příjem platby (povinné)
     * @see \IUcto\IUcto::getBankAccounts()
     *
     * @var int
     */
    private $bankAccount;

    /**
     * Datum zdanitelného plnění (formát YYYY-mm-dd)
     *
     * @var string
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
     * @see \IUcto\IUcto::getRoundingTypes()
     *
     * @var string
     */
    private $roundingType;

    /**
     * Id objednávky
     * @var int|null
     */
    private $orderId;

    /**
     * Položky dokladu (povinné)
     *
     * @var DocumentItem[]
     */
    private $items = array();

    public function __construct(array $dataArray = [])
    {
        if (empty($dataArray)) {
            return;
        }

        $this->variableSymbol = Utils::getValueOrNull($dataArray, 'variable_symbol');
        $this->sequenceCode = Utils::getValueOrNull($dataArray, 'sequence_code');
        $this->date = Utils::getValueOrNull($dataArray, 'date');
        $this->dateVat = Utils::getValueOrNull($dataArray, 'date_vat');
        $this->maturityDate = Utils::getValueOrNull($dataArray, 'maturity_date');
        $this->currency = Utils::getValueOrNull($dataArray, 'currency');
        $this->customerId = Utils::getValueOrNull($dataArray, 'customer_id');
        $this->customerBankAccount = Utils::getValueOrNull($dataArray, 'customer_bank_account');
        $this->paymentType = Utils::getValueOrNull($dataArray, 'payment_type');
        $this->bankAccount = Utils::getValueOrNull($dataArray, 'bank_account');
        $this->dateVatPrev = Utils::getValueOrNull($dataArray, 'date_vat_prev');
        $this->description = Utils::getValueOrNull($dataArray, 'description');
        $this->roundingType = Utils::getValueOrNull($dataArray, 'rounding_type');
        $this->orderId = Utils::getValueOrNull($dataArray, 'order_id');
        if (array_key_exists('items', $dataArray)) {
            foreach ($dataArray['items'] as $itemData) {
                $this->items[] = new DocumentItem($itemData);
            }
        }
    }

    public function getVariableSymbol()
    {
        return $this->variableSymbol;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDateVat()
    {
        return $this->dateVat;
    }

    public function getMaturityDate()
    {
        return $this->maturityDate;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getCustomerId()
    {
        return $this->customerId;
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

    public function setVariableSymbol($variableSymbol)
    {
        $this->variableSymbol = $variableSymbol;
    }

    /**
     *
     * @param int|\DateTime $input unix timestamp or DateTime object
     */
    public function setDate($input)
    {
        $this->date = Utils::getDateTimeFrom($input)->format('Y-m-d');
    }

    /**
     *
     * @param int|\DateTime $input unix timestamp or DateTime object
     */
    public function setDateVat($input)
    {
        $this->dateVat = Utils::getDateTimeFrom($input)->format('Y-m-d');
    }

    /**
     *
     * @param int|\DateTime $input unix timestamp or DateTime object
     */
    public function setMaturityDate($input)
    {
        $this->maturityDate = Utils::getDateTimeFrom($input)->format('Y-m-d');
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    public function setCustomerBankAccount($customerBankAccount)
    {
        $this->customerBankAccount = $customerBankAccount;
    }

    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
    }

    public function setBankAccount($bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }

    /**
     *
     * @param int|\DateTime $input unix timestamp or DateTime object
     */
    public function setDateVatPrev($input)
    {
        $this->dateVatPrev = Utils::getDateTimeFrom($input);
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
     * @return int|null
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param int|null $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }


    public function toArray()
    {
        $array = array('variable_symbol' => $this->variableSymbol,
            'sequence_code' => $this->sequenceCode,
            'date' => $this->date,
            'date_vat' => $this->dateVat,
            'maturity_date' => $this->maturityDate,
            'currency' => $this->currency,
            'customer_id' => $this->customerId,
            'customer_bank_account' => $this->customerBankAccount,
            'payment_type' => $this->paymentType,
            'bank_account' => $this->bankAccount,
            'date_vat_prev' => $this->dateVatPrev,
            'description' => $this->description,
            'rounding_type' => $this->roundingType,
            'order_id' => $this->orderId,
        );
        $array['items'] = array();
        foreach ($this->items as $item) {
            $array['items'][] = $item->toArray();
        }
        return $array;
    }

}
