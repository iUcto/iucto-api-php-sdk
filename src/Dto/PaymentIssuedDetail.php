<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for PaymentIssuedDetail data
 *
 * @author iucto.cz
 */
class PaymentIssuedDetail extends PaymentDetail
{

    /**
     * @var int|null
     */
    protected $proformaInvoiceId;

    /**
     * Opravný daňový doklad vydaný - detail
     *
     * @var CreditNoteIssuedDetail
     */
    protected $creditnote;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        parent::__construct($arrayData);

        $this->proformaInvoiceId = Utils::getValueOrNull($arrayData, 'proforma_invoice_received_id');
        if (isset($arrayData['creditnote']) AND $arrayData['creditnote'] !== null) {
            $this->creditnote = new CreditNoteIssuedDetail($arrayData['creditnote']);
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
     * @return CreditNoteIssuedDetail
     */
    public function getCreditnote()
    {
        return $this->creditnote;
    }

}
