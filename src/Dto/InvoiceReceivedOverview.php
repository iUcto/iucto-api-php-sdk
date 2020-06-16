<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for DocumentOverview data
 *
 * @author iucto.cz
 */
class InvoiceReceivedOverview
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
     * Variabilní symbol
     *
     * @var string (42)
     */
    private $variableSymbol;

    /**
     * Datum vystavení (YYYY-mm-dd)
     *
     * @var string
     */
    private $date;

    /**
     * Datum zdanitelného plnění (YYYY-mm-dd)
     *
     * @var string
     */
    private $dateVat;

    /**
     * Datum splatnosti (YYYY-mm-dd)
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
     * Celková částka v CZK s DPH
     *
     * @var int(11)
     */
    private $priceIncVat;

    /**
     * Zbývající částka k úhradě (v měně dokladu)
     *
     * @var int
     */
    private $toBePaid;

    /**
     * Zákazník
     *
     * @var SupplierOverview
     */
    private $supplier;

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

    /**
     * ID zálohových faktur
     *
     * @var array
     */
    private $proformaInvoiceIds;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->sequenceCode = Utils::getValueOrNull($arrayData, 'sequence_code');
        $this->variableSymbol = Utils::getValueOrNull($arrayData, 'variable_symbol');
        $this->date = Utils::getValueOrNull($arrayData, 'date');
        $this->dateVat = Utils::getValueOrNull($arrayData, 'date_vat');
        $this->maturityDate = Utils::getValueOrNull($arrayData, 'maturity_date');
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
        $this->priceIncVat = Utils::getValueOrNull($arrayData, 'price_inc_vat');
        $this->toBePaid = Utils::getValueOrNull($arrayData, 'to_be_paid');
        $this->supplier = new SupplierOverview($arrayData['supplier']);
        $this->accounted = Utils::getValueOrNull($arrayData, 'accounted');
        $this->deleted = Utils::getValueOrNull($arrayData, 'deleted');
        $this->proformaInvoiceIds = Utils::getValueOrNull($arrayData, 'proforma_invoice_id');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSequenceCode()
    {
        return $this->sequenceCode;
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

    public function getPriceIncVat()
    {
        return $this->priceIncVat;
    }

    public function getToBePaid()
    {
        return $this->toBePaid;
    }

    public function getSupplier()
    {
        return $this->supplier;
    }

    public function getAccounted()
    {
        return $this->accounted;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function getProformaInvoiceIds()
    {
        return $this->proformaInvoiceIds;
    }
}
