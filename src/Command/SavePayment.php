<?php

namespace IUcto\Command;

use IUcto;
use IUcto\Dto\PaymentItem;
use IUcto\Utils;

/**
 * Comman object pro uložení dokumentu
 *
 * @author iucto.cz
 */
class SavePayment
{

    /**
     * Variabilní symbol (povinné)
     *
     * @var string (42)
     */
    private $variableSymbol;

    /**
     * Datum vystavení (povinné) (formát YYYY-mm-dd)
     *
     * @var \DateTime
     */
    private $date;

    /**
     * Datum zdanitelného plnění (povinné) (formát YYYY-mm-dd)
     *
     * @var \DateTime
     */
    private $dateVat;

    /**
     * Měna dokladu (povinné)
     * @see IUcto\IUcto::getCurrencies()
     *
     * @var string (3)
     */
    private $currency;

    /**
     * Zákazník (povinné)
     * @see IUcto\IUcto::getCustomers()
     *
     * @var int
     */
    private $customerId;


    private $supplierId;

    /**
     * Bankovní účet zákazníka
     *
     * @var string (45)
     */
    private $customerBankAccount;

    /**
     * Forma úhrady
     * @see IUcto\IUcto::getPaymentTypes()
     *
     * @var int(1)
     */
    private $paymentType;

    /**
     * Bankovního účet pro příjem platby (povinné pro platbu převodem)
     * @see IUcto\IUcto::getBankAccounts()
     *
     * @var int
     */
    private $bankAccount;

    /**
     * Pokladna pro příjem platby (povinné pro platbu v hotovosti)
     * @var int
     */
    private $cash_register_id;

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
     * @see IUcto\IUcto::getRoundingTypes()
     *
     * @var string
     */
    private $roundingType;

    /**
     * Položky dokladu (povinné)
     *
     * @var IUcto\Dto\DocumentItem[]
     */
    private $items = array();

    /**
     * @var int|null
     */
    private $invoiceId;

    public function __construct(array $dataArray = [])
    {
        if (empty($dataArray)) {
            return;
        }

        $this->variableSymbol = Utils::getValueOrNull($dataArray, 'variable_symbol');
        $this->date = isset($dataArray['date']) ? Utils::getDateTimeFrom($dataArray['date']) : null;
        $this->dateVat = isset($dataArray['date_vat']) ? Utils::getDateTimeFrom($dataArray['date_vat']) : null;
        $this->invoiceId = Utils::getValueOrNull($dataArray, 'invoice_id');
        $this->currency = Utils::getValueOrNull($dataArray, 'currency');
        $this->customerId = Utils::getValueOrNull($dataArray, 'customer_id');
        $this->supplierId = Utils::getValueOrNull($dataArray, 'supplier_id');
        $this->customerBankAccount = Utils::getValueOrNull($dataArray, 'customer_bank_account');
        $this->paymentType = Utils::getValueOrNull($dataArray, 'payment_type');
        $this->bankAccount = Utils::getValueOrNull($dataArray, 'bank_account');
        $this->cash_register_id = Utils::getValueOrNull($dataArray, 'cash_register_id');
        $this->dateVatPrev = Utils::getValueOrNull($dataArray, 'date_vat_prev');
        $this->description = Utils::getValueOrNull($dataArray, 'description');
        $this->roundingType = Utils::getValueOrNull($dataArray, 'rounding_type');
        if (array_key_exists('items', $dataArray)) {
            foreach ($dataArray['items'] as $itemData) {
                $this->items[] = new PaymentItem((array)$itemData);
            }
        }
    }

    public function getVariableSymbol()
    {
        return $this->variableSymbol;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->date;
    }

    public function getDateVat()
    {
        return $this->dateVat;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getSupplierId()
    {
        return $this->supplierId;
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

    public function getCashRegisterId()
    {
        return $this->cash_register_id;
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
     * @return int|null
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * @param int|null $invoiceId
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }


    public function setVariableSymbol($variableSymbol)
    {
        $this->variableSymbol = $variableSymbol;
    }

    /**
     *
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     *
     * @param \DateTime $dateVat
     */
    public function setDateVat(\DateTime $dateVat)
    {
        $this->dateVat = $dateVat;
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
     * @param int $cash_register_id
     */
    public function setCashRegisterId($cash_register_id)
    {
        $this->cash_register_id = $cash_register_id;
    }


    public function toArray()
    {
        $array = array(
            'variable_symbol' => $this->variableSymbol,
            'date' => $this->date != null ? $this->date->format('Y-m-d') : null,
            'date_vat' => $this->dateVat != null ? $this->dateVat->format('Y-m-d') : null,
            'currency' => $this->currency,
            'customer_id' => $this->customerId,
            'supplier_id' => $this->supplierId,
            'invoice_id' => $this->invoiceId,
            'customer_bank_account' => $this->customerBankAccount,
            'payment_type' => $this->paymentType,
            'bank_account' => $this->bankAccount,
            'cash_register_id' => $this->cash_register_id,
            'date_vat_prev' => $this->dateVatPrev,
            'description' => $this->description,
            'rounding_type' => $this->roundingType
        );
        $array['items'] = array();
        foreach ($this->items as $item) {
            $array['items'][] = $item->toArray();
        }
        return $array;
    }

    /**
     * @param int $getSupplierId
     */
    public function setSupplierId($getSupplierId)
    {
        $this->supplierId = $getSupplierId;
    }

}
