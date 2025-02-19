<?php

namespace IUcto\Command;

use IUcto\Utils;

/**
 * Description of SaveBankTransaction
 *
 * @author iucto.cz
 */
class SaveBankTransaction
{

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
     * Částka v původní měně
     * @var float|null
     */
    protected $amount_original = null;

    /**
     * Původní měna záznamu
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
     * @return array
     */
    public function toArray()
    {
        $data = [
            'payment_type' => $this->payment_type,
            'price' => $this->price,
            'currency' => $this->currency,
            'date_payment' => $this->date_payment != null ? $this->date_payment->format('Y-m-d') : null,
            'item_type' => $this->item_type,
            'variable_symbol' => $this->variable_symbol,
            'constant_symbol' => $this->constant_symbol,
            'specific_symbol' => $this->specific_symbol,
            'bank_account' => $this->bank_account,
            'bank_account_contraparty' => $this->bank_account_contraparty,
            'variable_symbol2' => $this->variable_symbol2,
            'description_tome' => $this->description_tome,
            'description_toyou' => $this->description_toyou,
            'reference_number' => $this->reference_number,
            'counterparty' => $this->counterparty,
            'vat_type' => $this->vat_type,
            'account_entry_type' => $this->account_entry_type,
            'chart_account' => $this->chart_account,
            'vat_chart' => $this->vat_chart
        ];

        $originals = [
            'amount_original' => $this->amount_original,
            'currency_original' => $this->currency_original,
        ];

        if ($this->amount_original || $this->currency_original) {
            $data = array_merge($data, $originals);
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->payment_type;
    }

    /**
     * @param string $payment_type
     * @return SaveBankTransaction
     */
    public function setPaymentType($payment_type)
    {
        $this->payment_type = $payment_type;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return SaveBankTransaction
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return SaveBankTransaction
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDatePayment()
    {
        return $this->date_payment;
    }

    /**
     * @param \DateTime $date_payment
     * @return SaveBankTransaction
     */
    public function setDatePayment(\DateTime $date_payment)
    {
        $this->date_payment = $date_payment;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemType()
    {
        return $this->item_type;
    }

    /**
     * @param string $item_type
     * @return SaveBankTransaction
     */
    public function setItemType($item_type)
    {
        $this->item_type = $item_type;
        return $this;
    }

    /**
     * @return string
     */
    public function getVariableSymbol()
    {
        return $this->variable_symbol;
    }

    /**
     * @param string $variable_symbol
     * @return SaveBankTransaction
     */
    public function setVariableSymbol($variable_symbol)
    {
        $this->variable_symbol = $variable_symbol;
        return $this;
    }

    /**
     * @return string
     */
    public function getConstantSymbol()
    {
        return $this->constant_symbol;
    }

    /**
     * @param string $constant_symbol
     * @return SaveBankTransaction
     */
    public function setConstantSymbol($constant_symbol)
    {
        $this->constant_symbol = $constant_symbol;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpecificSymbol()
    {
        return $this->specific_symbol;
    }

    /**
     * @param string $specific_symbol
     * @return SaveBankTransaction
     */
    public function setSpecificSymbol($specific_symbol)
    {
        $this->specific_symbol = $specific_symbol;
        return $this;
    }

    /**
     * @return int
     */
    public function getBankAccount()
    {
        return $this->bank_account;
    }

    /**
     * @param int $bank_account
     * @return SaveBankTransaction
     */
    public function setBankAccount($bank_account)
    {
        $this->bank_account = $bank_account;
        return $this;
    }

    /**
     * @return string
     */
    public function getBankAccountContraparty()
    {
        return $this->bank_account_contraparty;
    }

    /**
     * @param string $bank_account_contraparty
     * @return SaveBankTransaction
     */
    public function setBankAccountContraparty($bank_account_contraparty)
    {
        $this->bank_account_contraparty = $bank_account_contraparty;
        return $this;
    }

    /**
     * @return string
     */
    public function getVariableSymbol2()
    {
        return $this->variable_symbol2;
    }

    /**
     * @param string $variable_symbol2
     * @return SaveBankTransaction
     */
    public function setVariableSymbol2($variable_symbol2)
    {
        $this->variable_symbol2 = $variable_symbol2;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionTome()
    {
        return $this->description_tome;
    }

    /**
     * @param string $description_tome
     * @return SaveBankTransaction
     */
    public function setDescriptionTome($description_tome)
    {
        $this->description_tome = $description_tome;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionToyou()
    {
        return $this->description_toyou;
    }

    /**
     * @param string $description_toyou
     * @return SaveBankTransaction
     */
    public function setDescriptionToyou($description_toyou)
    {
        $this->description_toyou = $description_toyou;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->reference_number;
    }

    /**
     * @param string $reference_number
     * @return SaveBankTransaction
     */
    public function setReferenceNumber($reference_number)
    {
        $this->reference_number = $reference_number;
        return $this;
    }

    /**
     * @return int
     */
    public function getCounterparty()
    {
        return $this->counterparty;
    }

    /**
     * @param int $counterparty
     * @return SaveBankTransaction
     */
    public function setCounterparty($counterparty)
    {
        $this->counterparty = $counterparty;
        return $this;
    }

    /**
     * @return int
     */
    public function getVatType()
    {
        return $this->vat_type;
    }

    /**
     * @param int $vat_type
     * @return SaveBankTransaction
     */
    public function setVatType($vat_type)
    {
        $this->vat_type = $vat_type;
        return $this;
    }

    /**
     * @return int
     */
    public function getAccountEntryType()
    {
        return $this->account_entry_type;
    }

    /**
     * @param int $account_entry_type
     * @return SaveBankTransaction
     */
    public function setAccountEntryType($account_entry_type)
    {
        $this->account_entry_type = $account_entry_type;
        return $this;
    }

    /**
     * @return int
     */
    public function getChartAccount()
    {
        return $this->chart_account;
    }

    /**
     * @param int $chart_account
     * @return SaveBankTransaction
     */
    public function setChartAccount($chart_account)
    {
        $this->chart_account = $chart_account;
        return $this;
    }

    /**
     * @return int
     */
    public function getVatChart()
    {
        return $this->vat_chart;
    }

    /**
     * @param int $vat_chart
     * @return SaveBankTransaction
     */
    public function setVatChart($vat_chart)
    {
        $this->vat_chart = $vat_chart;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getAmountOriginal()
    {
        return $this->amount_original;
    }

    /**
     * @param float|null $amount
     * @return SaveBankTransaction
     */
    public function setAmountOriginal($amount)
    {
        $this->amount_original = $amount;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrencyOriginal()
    {
        return $this->currency_original;
    }

    /**
     * @param string|null $currency
     * @return SaveBankTransaction
     */
    public function setCurrencyOriginal($currency)
    {
        $this->currency_original = $currency;
        return $this;
    }
}
