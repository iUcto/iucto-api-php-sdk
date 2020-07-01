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
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        parent::__construct($arrayData);

        $this->proformaInvoiceId = Utils::getValueOrNull($arrayData, 'proforma_invoice_received_id');
    }

    /**
     * @return int|null
     */
    public function getProformaInvoiceId()
    {
        return $this->proformaInvoiceId;
    }

}
