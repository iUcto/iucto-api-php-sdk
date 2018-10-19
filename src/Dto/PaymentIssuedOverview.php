<?php

namespace IUcto\Dto;

/**
 * DTO for PaymentIssuedOverview data
 *
 * @author iucto.cz
 */
class PaymentIssuedOverview extends PaymentOverview
{

    /**
     * @var InvoiceReceivedOverview
     */
    protected $invoice;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        parent::__construct($arrayData);
        if (!is_null($arrayData['invoice'])) {
            $this->invoice = new InvoiceReceivedOverview($arrayData['invoice']);
        } else {
            $this->invoice = null;
        }
    }

    /**
     * @return InvoiceReceivedOverview
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

}
