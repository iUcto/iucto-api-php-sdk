<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for DocumentOverview data
 *
 * @author iucto.cz
 */
class ProformaInvoiceIssuedOverview
{

    /**
     * ID dokladu
     *
     * @var int
     */
    protected $id;

    /**
     * Číslo dokladu
     *
     * @var string
     */
    protected $sequenceCode;

    /**
     * Variabilní symbol
     *
     * @var string
     */
    protected $variableSymbol;

    /**
     * Datum vystavení (formát YYYY-mm-dd)
     *
     * @var string
     */
    protected $date;

    /**
     * Datum zdanitelného plnění (formát YYYY-mm-dd)
     *
     * @var string
     */
    protected $dateVat;

    /**
     * Datum splatnosti (formát YYYY-mm-dd)
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
     * Celková částka s DPH
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
     * Zákazník
     *
     * @var CustomerOverview
     */
    private $customer;

    /**
     * Doklad je smazaný
     *
     * @var bool
     */
    protected $deleted;

    /**
     * Zbývající částka k fakturaci
     *
     * @var int
     */
    protected $toBeInvoiced;


    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->sequenceCode = Utils::getValueOrNull($arrayData, 'sequence_code');
        $this->variableSymbol = Utils::getValueOrNull($arrayData, 'variable_symbol');
        $this->date = Utils::getDateTimeFrom($arrayData['date']);
        $this->dateVat = Utils::getDateTimeFrom($arrayData['date_vat']);
        $this->maturityDate = Utils::getDateTimeFrom($arrayData['maturity_date']);
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
        $this->priceIncVat = Utils::getValueOrNull($arrayData, 'price_inc_vat');
        $this->toBeInvoiced = Utils::getValueOrNull($arrayData, 'to_be_invoiced');
        $this->toBePaid = Utils::getValueOrNull($arrayData, 'to_be_paid');
        if (array_key_exists('customer', $arrayData)) {
            $this->customer = new CustomerOverview($arrayData['customer']);
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

    /**
     * @return CustomerOverview
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    public function getToBeInvoiced()
    {
        return $this->toBeInvoiced;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

}
