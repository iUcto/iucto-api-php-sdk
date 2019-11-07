<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for ProformaInvoiceReceivedDetail data
 *
 * @author iucto.cz
 */
class ProformaInvoiceReceivedDetail
{

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
     * Externí kód
     *
     * @var string (45)
     */
    private $externalCode;

    /**
     * Variabilní symbol
     *
     * @var string (42)
     */
    private $variableSymbol;

    /**
     * Datum vystavení (formát YYYY-mm-dd)
     *
     * @var string
     */
    private $date;

    /**
     * Datum zdanitelného plnění (formát YYYY-mm-dd)
     *
     * @var string
     */
    private $dateVat;

    /**
     * Datum splatnosti (formát YYYY-mm-dd)
     *
     * @var string
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
     * Zbývající částka k doplacení
     *
     * @var int
     */
    private $toBeInvoiced;

    /**
     * Zákazník
     *
     * @var Supplier
     */
    private $supplier;


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
     * Doklad je smazaný
     *
     * @var bool
     */
    private $deleted;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->sequenceCode = Utils::getValueOrNull($arrayData, 'sequence_code');
        $this->externalCode = Utils::getValueOrNull($arrayData, 'external_code');
        $this->variableSymbol = Utils::getValueOrNull($arrayData, 'variable_symbol');
        $this->date = Utils::getDateTimeFrom($arrayData['date']);
        $this->dateVat = Utils::getDateTimeFrom($arrayData['date_vat']);
        $this->maturityDate = Utils::getDateTimeFrom($arrayData['maturity_date']);
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
        $this->price = Utils::getValueOrNull($arrayData, 'price');
        $this->priceCzk = Utils::getValueOrNull($arrayData, 'price_czk');
        $this->priceIncVat = Utils::getValueOrNull($arrayData, 'price_inc_vat');
        $this->priceIncVatCzk = Utils::getValueOrNull($arrayData, 'price_inc_vat_czk');
        $this->toBePaid = Utils::getValueOrNull($arrayData, 'to_be_paid');
        $this->toBeInvoiced = Utils::getValueOrNull($arrayData, 'to_be_invoiced');
        if (array_key_exists('supplier', $arrayData)) {
            $this->supplier = new Supplier($arrayData['supplier']);
        }
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
        $this->deleted = Utils::getValueOrNull($arrayData, 'deleted');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSequenceCode()
    {
        return $this->sequenceCode;
    }

    public function getExternalCode()
    {
        return $this->externalCode;
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

    public function getPrice()
    {
        return $this->price;
    }

    public function getPriceCzk()
    {
        return $this->priceCzk;
    }

    public function getPriceIncVat()
    {
        return $this->priceIncVat;
    }

    public function getPriceIncVatCzk()
    {
        return $this->priceIncVatCzk;
    }

    public function getToBePaid()
    {
        return $this->toBePaid;
    }

    public function getSupplier()
    {
        return $this->supplier;
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

    public function getDeleted()
    {
        return $this->deleted;
    }

}
