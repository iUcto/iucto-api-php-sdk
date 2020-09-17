<?php

namespace IUcto\Command;

use IUcto\Dto\DocumentItem;
use IUcto\Utils;

/**
 * Comman object pro uložení dokumentu
 *
 * @author iucto.cz
 */
class SaveCreditNoteReceived
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
     * Dodavatel (povinné)
     * @see \IUcto\IUcto::getSuppliers()
     *
     * @var int
     */
    private $supplierId;

    /**
     * Bankovní účet dodavatele
     *
     * @var string (45)
     */
    private $supplierBankAccount;

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
     * Datum kurzu cizí měny (formát YYYY-mm-dd)
     *
     * @var string
     */
    private $currencyDate;

    /**
     * Id faktury
     * @var int|null
     */
    private $invoiceReceivedId;

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
        $this->supplierId = Utils::getValueOrNull($dataArray, 'supplier_id');
        $this->supplierBankAccount = Utils::getValueOrNull($dataArray, 'supplier_bank_account');
        $this->paymentType = Utils::getValueOrNull($dataArray, 'payment_type');
        $this->bankAccount = Utils::getValueOrNull($dataArray, 'bank_account');
        $this->dateVatPrev = Utils::getValueOrNull($dataArray, 'date_vat_prev');
        $this->description = Utils::getValueOrNull($dataArray, 'description');
        $this->roundingType = Utils::getValueOrNull($dataArray, 'rounding_type');
        $this->currencyDate = Utils::getValueOrNull($dataArray, 'currency_date');
        $this->invoiceIssuedId = Utils::getValueOrNull($dataArray, 'invoice_issued_id');
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

    public function getSupplierId()
    {
        return $this->supplierId;
    }

    public function getSupplierBankAccount()
    {
        return $this->supplierBankAccount;
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

    public function getCurrencyDate()
    {
        return $this->currencyDate;
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

    public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;
    }

    public function setSupplierBankAccount($supplierBankAccount)
    {
        $this->supplierBankAccount = $supplierBankAccount;
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

    public function setCurrencyDate($currencyDate)
    {
        $this->currencyDate = $currencyDate;
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
    public function getInvoiceReceivedId()
    {
        return $this->invoiceReceivedId;
    }

    /**
     * @param int|null $invoiceReceivedId
     */
    public function setInvoiceReceivedId($invoiceReceivedId)
    {
        $this->invoiceReceivedId = $invoiceReceivedId;
    }


    public function toArray()
    {
        $array = [
            'variable_symbol' => $this->variableSymbol,
            'sequence_code' => $this->sequenceCode,
            'date' => $this->date,
            'date_vat' => $this->dateVat,
            'maturity_date' => $this->maturityDate,
            'currency' => $this->currency,
            'supplier_id' => $this->supplierId,
            'supplier_bank_account' => $this->supplierBankAccount,
            'payment_type' => $this->paymentType,
            'bank_account' => $this->bankAccount,
            'date_vat_prev' => $this->dateVatPrev,
            'description' => $this->description,
            'rounding_type' => $this->roundingType,
            'currency_date' => $this->currencyDate,
            'invoice_received_id' => $this->invoiceReceivedId,
        ];
        $array['items'] = array();
        foreach ($this->items as $item) {
            $array['items'][] = $item->toArray();
        }
        return $array;
    }

}
