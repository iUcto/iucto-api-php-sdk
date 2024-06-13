<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for OrderIssuedOverview data
 *
 * @author iucto.cz
 */
class OrderIssuedOverview extends RawData
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
     * Datum vystavení (YYYY-mm-dd)
     *
     * @var string
     */
    private $date;

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
     * Dodavatel
     *
     * @var SupplierOverview
     */
    private $supplier;

    /**
     * ID spárované faktury vydaná
     *
     * @var int|null
     */
    private $invoiceId;

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
        $this->date = Utils::getValueOrNull($arrayData, 'date');
        $this->currency = Utils::getValueOrNull($arrayData, 'currency');
        $this->priceIncVat = Utils::getValueOrNull($arrayData, 'price_inc_vat');
        $this->supplier = new SupplierOverview($arrayData['supplier']);
        $this->invoiceId = Utils::getValueOrNull($arrayData, 'invoice_id');
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

    public function getDate()
    {
        return $this->date;
    }


    public function getCurrency()
    {
        return $this->currency;
    }

    public function getPriceIncVat()
    {
        return $this->priceIncVat;
    }


    public function getSupplier()
    {
        return $this->supplier;
    }

    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

}
