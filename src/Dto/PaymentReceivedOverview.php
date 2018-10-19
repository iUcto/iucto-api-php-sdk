<?php

namespace IUcto\Dto;

/**
 * DTO for PaymentIssuedOverview data
 *
 * @author iucto.cz
 */
class PaymentReceivedOverview extends PaymentOverview
{

    /**
     * @var InvoiceIsseudOverview
     */
    protected $invoice;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        parent::__construct($arrayData);
        if (!is_null($arrayData['invoice'])) {
            $this->invoice = new InvoiceIsseudOverview($arrayData['invoice']);
        } else {
            $this->invoice = null;
        }
    }

    /**
     * @return InvoiceIsseudOverview
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
}
