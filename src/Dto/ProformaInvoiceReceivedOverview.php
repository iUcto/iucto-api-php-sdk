<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for ProformaInvoiceReceivedOverview data
 *
 * @author iucto.cz
 */
class ProformaInvoiceReceivedOverview
{

    /**
     * ID dokladu
     *
     * @var int(11)
     */
    protected $id;

    /**
     * Číslo dokladu
     *
     * @var string (45)
     */
    protected $sequenceCode;

    /**
     * External code
     *
     * @var string (45)
     */
    protected $externalCode;

    /**
     * Variabilní symbol
     *
     * @var string (42)
     */
    protected $variableSymbol;

    /**
     * Datum vystavení (YYYY-mm-dd)
     *
     * @var string
     */
    protected $date;

    /**
     * Datum zdanitelného plnění (YYYY-mm-dd)
     *
     * @var string
     */
    protected $dateVat;

    /**
     * Datum splatnosti (YYYY-mm-dd)
     *
     * @var string
     */
    protected $maturityDate;

    /**
     * Měna dokladu
     *
     * @var string (3)
     */
    protected $currency;

    /**
     * Celková částka v CZK s DPH
     *
     * @var int(11)
     */
    protected $priceIncVat;

    /**
     * Zbývající částka k úhradě (v měně dokladu)
     *
     * @var int
     */
    protected $toBePaid;

    /**
     * Zbývající částka k odečtení
     *
     * @var int
     */
    protected $toBeInvoiced;

    /**
     * Dodavatel
     *
     * @var SupplierOverview
     */
    private $supplier;

    /**
     * Doklad je smazaný
     *
     * @var bool
     */
    protected $deleted;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->sequenceCode = Utils::getValueOrNull($arrayData, 'sequence_code');
        $this->externalCode = Utils::getValueOrNull($arrayData, 'external_code');
        $this->variableSymbol = Utils::getValueOrNull($arrayData, 'variable_symbol');
        $this->date = Utils::getValueOrNull($arrayData, 'date');
        $this->dateVat = Utils::getValueOrNull($arrayData, 'date_vat');
        $this->maturityDate = Utils::getValueOrNull($arrayData, 'maturity_date');
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
        $this->priceIncVat = Utils::getValueOrNull($arrayData, 'price_inc_vat');
        $this->toBePaid = Utils::getValueOrNull($arrayData, 'to_be_paid');
        $this->toBeInvoiced = Utils::getValueOrNull($arrayData, 'to_be_invoiced');
        if (array_key_exists('supplier', $arrayData)) {
            $this->supplier = new SupplierOverview($arrayData['supplier']);
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

    public function getPriceIncVat()
    {
        return $this->priceIncVat;
    }

    public function getToBePaid()
    {
        return $this->toBePaid;
    }

    public function getToBeInvoiced()
    {
        return $this->toBeInvoiced;
    }

    /**
     * @return SupplierOverview
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }
}
