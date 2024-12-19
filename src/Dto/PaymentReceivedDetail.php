<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for PaymentReceivedDetail data
 *
 * @author iucto.cz
 */
class PaymentReceivedDetail extends PaymentDetail
{

    /**
     * @var int|null
     */
    protected $proformaInvoiceId;

    /**
     * Opravný daňový doklad přijatý - detail
     *
     * @var CreditNoteReceivedDetail
     */
    protected $creditnote;

    /**
     * @var bool|null
     */
    protected $eet;

    /**
     * @var array
     */
    protected $eetStatus;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        parent::__construct($arrayData);

        $this->proformaInvoiceId = Utils::getValueOrNull($arrayData, 'proforma_invoice_received_id');

        $this->eet = Utils::getValueOrNull($arrayData, 'eet');
        $this->eetStatus = Utils::getValueOrNull($arrayData, 'eet_status');

        if (isset($arrayData['creditnote']) && $arrayData['creditnote'] !== null) {
            $this->creditnote = new CreditNoteReceivedDetail($arrayData['creditnote']);
        }
    }

    /**
     * @return int|null
     */
    public function getProformaInvoiceId()
    {
        return $this->proformaInvoiceId;
    }

    /**
     * @return CreditNoteReceivedDetail
     */
    public function getCreditnote()
    {
        return $this->creditnote;
    }

    /**
     * @return bool|null
     */
    public function getEet()
    {
        return $this->eet;
    }

    /**
     * @return array
     */
    public function getEetStatus()
    {
        return $this->eetStatus;
    }



}
