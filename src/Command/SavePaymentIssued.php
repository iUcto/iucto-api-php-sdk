<?php

namespace IUcto\Command;

use IUcto;
use IUcto\Utils;

/**
 * @author iucto.cz
 */
class SavePaymentIssued extends SavePayment
{

    /**
     * ID zálohové faktury přijaté
     * @var int|null
     */
    protected $proformaInvoiceId;

    /**
     * ID opravného daňového dokladu vydané
     * @var int|null
     */
    protected $creditnoteId;

    public function __construct(array $dataArray = [])
    {
        parent::__construct($dataArray);

        if (empty($dataArray)) {
            return;
        }

        $this->proformaInvoiceId = Utils::getValueOrNull($dataArray, 'proforma_invoice_received_id');
        $this->creditnoteId = Utils::getValueOrNull($dataArray, 'creditnote_id');
    }

    public function toArray()
    {
        $array = parent::toArray();

        $array['proforma_invoice_received_id'] = $this->proformaInvoiceId;
        $array['creditnote_id'] = $this->creditnoteId;
        return $array;
    }

    /**
     * @return int|null
     */
    public function getProformaInvoiceId()
    {
        return $this->proformaInvoiceId;
    }

    /**
     * @param int|null $proformaInvoiceId
     */
    public function setProformaInvoiceId($proformaInvoiceId)
    {
        $this->proformaInvoiceId = $proformaInvoiceId;
    }

    /**
     * @return int|null
     */
    public function getCreditnoteId()
    {
        return $this->creditnoteId;
    }

    /**
     * @param int|null $creditnoteId
     */
    public function setCreditnoteId($creditnoteId)
    {
        $this->creditnoteId = $creditnoteId;
    }




}
