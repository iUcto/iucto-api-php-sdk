<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * Description of SaveBankTransaction
 *
 * @author iucto.cz
 */
class BankTransactionOverview extends RawData
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
     * Datum importu
     * @var string
     */
    protected $created = null;

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
     * @var string
     */
    protected $variable_symbol2 = null;

    /**
     * Poznámka pro mě
     * @var string
     */
    protected $description_tome = null;

    /**
     * Poznámka pro mě
     * @var string
     */
    protected $description_toyou = null;

    /**
     * Vlastní identifikátor pohybu
     * @var string
     */
    protected $reference_number = null;

    /**
     * ID protistrany, pro příchozí pohyb Zákazník, pro odchozí Dodavatel
     * @var int
     */
    protected $counterparty = null;

    /**
     * Typ DPH
     * @var int
     */
    protected $vat_type = null;

    /**
     * Typ účetní položky
     * @var int
     */
    protected $account_entry_type = null;

    /**
     * Účet úč. osnovy
     * @var int
     */
    protected $chart_account = null;

    /**
     * Účet DPH
     * @var int
     */
    protected $vat_chart = null;

    /**
     * @var float|null
     */
    protected $amount_original = null;

    /**
     * @var string|null
     */
    protected $currency_original = null;


    /**
     * @param array $arrayData
     */
    function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) {
            return;
        }

        // Readonly
        $this->id = $arrayData['id'];
        $this->price_czk = $arrayData['price_czk'];
        $this->status = $arrayData['status'];
        $this->linked_docs = $arrayData['linked_docs'];
        $this->created = $arrayData['created'];

        // Required
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
        $this->variable_symbol2 = Utils::getValueOrNull($arrayData, 'variable_symbol2');
        $this->description_tome = Utils::getValueOrNull($arrayData, 'description_tome');
        $this->description_toyou = Utils::getValueOrNull($arrayData, 'description_toyou');
        $this->reference_number = Utils::getValueOrNull($arrayData, 'reference_number');
        $this->counterparty = Utils::getValueOrNull($arrayData, 'counterparty');
        $this->vat_type = Utils::getValueOrNull($arrayData, 'vat_type');
        $this->account_entry_type = Utils::getValueOrNull($arrayData, 'account_entry_type');
        $this->chart_account = Utils::getValueOrNull($arrayData, 'chart_account');
        $this->vat_chart = Utils::getValueOrNull($arrayData, 'vat_chart');
        $this->amount_original = Utils::getValueOrNull($arrayData, 'amount_original');
        $this->currency_original = Utils::getValueOrNull($arrayData, 'currency_original');
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
    public function getCreated()
    {
        return $this->created;
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

    /**
     * @return string
     */
    public function getVariableSymbol2()
    {
        return $this->variable_symbol2;
    }

    /**
     * @return string
     */
    public function getDescriptionTome()
    {
        return $this->description_tome;
    }

    /**
     * @return string
     */
    public function getDescriptionToyou()
    {
        return $this->description_toyou;
    }

    /**
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->reference_number;
    }

    /**
     * @return int
     */
    public function getCounterparty()
    {
        return $this->counterparty;
    }

    /**
     * @return int
     */
    public function getVatType()
    {
        return $this->vat_type;
    }

    /**
     * @return int
     */
    public function getAccountEntryType()
    {
        return $this->account_entry_type;
    }

    /**
     * @return int
     */
    public function getChartAccount()
    {
        return $this->chart_account;
    }

    /**
     * @return int
     */
    public function getVatChart()
    {
        return $this->vat_chart;
    }

    /**
     * @return float|null
     */
    public function getAmountOriginal()
    {
        return $this->amount_original;
    }

    /**
     * @return string|null
     */
    public function getCurrencyOriginal()
    {
        return $this->currency_original;
    }

}
