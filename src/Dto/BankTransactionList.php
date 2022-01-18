<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * Description of BankTransactionList
 *
 * @author iucto.cz
 */
class BankTransactionList
{

    /**
     * Unikátní id transakce v systému
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $status;

    /**
     * Částka v CZK podle kurzu k datu pohybu
     * @var float
     */
    protected $price_czk;

    /**
     * Seznam spárovaných dokladů
     * @var array
     */
    protected $linked_docs;

    /**
     * Směř pohybu
     * @var string in/out
     */
    protected $payment_type;

    /**
     * Částka
     * @var float
     */
    protected $price;

    /**
     * Měna
     * @var string
     */
    protected $currency;

    /**
     * Datum platby
     * @var \DateTime
     */
    protected $date_payment = null;

    /**
     * Typ položky (popisek)
     * @var string
     */
    protected $item_type = null;

    /**
     * Variabilní symbol
     * @var string
     */
    protected $variable_symbol = null;

    /**
     * Konstantní symbol
     * @var string
     */
    protected $constant_symbol = null;

    /**
     * Specifický symbol
     * @var string
     */
    protected $specific_symbol = null;

    /**
     * ID bankovního účtu
     * @var int
     */
    protected $bank_account = null;

    /**
     * Číslo bankovního účtu protistrany
     * @var string
     */
    protected $bank_account_contraparty = null;

    /**
     * @param array $arrayData
     */
    function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) {
            return;
        }

        // Required
        $this->id = $arrayData["id"];
        $this->status = $arrayData["status"];
        $this->payment_type = $arrayData['payment_type'];
        $this->price = $arrayData['price'];
        $this->currency = $arrayData['currency'];

        // Optional
        $this->date_payment = isset($arrayData['date_payment']) ? Utils::getDateTimeFrom($arrayData['date_payment']) : null;
        $this->item_type = Utils::getValueOrNull($arrayData, 'item_type');
        $this->variable_symbol = Utils::getValueOrNull($arrayData, 'variable_symbol');
        $this->constant_symbol = Utils::getValueOrNull($arrayData, 'constant_symbol');
        $this->specific_symbol = Utils::getValueOrNull($arrayData, 'specific_symbol');
        $this->bank_account = Utils::getValueOrNull($arrayData, 'bank_account');
        $this->bank_account_contraparty = Utils::getValueOrNull($arrayData, 'bank_account_contraparty');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return float
     */
    public function getPriceCzk()
    {
        return $this->price_czk;
    }

    /**
     * @return array
     */
    public function getLinkedDocs()
    {
        return $this->linked_docs;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->payment_type;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return \DateTime
     */
    public function getDatePayment()
    {
        return $this->date_payment;
    }

    /**
     * @return string
     */
    public function getItemType()
    {
        return $this->item_type;
    }

    /**
     * @return string
     */
    public function getVariableSymbol()
    {
        return $this->variable_symbol;
    }

    /**
     * @return string
     */
    public function getConstantSymbol()
    {
        return $this->constant_symbol;
    }

    /**
     * @return string
     */
    public function getSpecificSymbol()
    {
        return $this->specific_symbol;
    }

    /**
     * @return int
     */
    public function getBankAccount()
    {
        return $this->bank_account;
    }

    /**
     * @return string
     */
    public function getBankAccountContraparty()
    {
        return $this->bank_account_contraparty;
    }

}
