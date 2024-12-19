<?php

namespace IUcto\Dto;

use IUcto\Utils;

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
     * @var CreditNoteReceivedOverview
     */
    protected $creditnote;

    /**
     * @var bool
     */
    protected $eet;

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

        if (!is_null($arrayData['creditnote'])) {
            $this->creditnote = new CreditNoteReceivedOverview($arrayData['creditnote']);
        } else {
            $this->creditnote = null;
        }

        $this->eet = Utils::getValueOrNull($arrayData, 'eet');
    }

    /**
     * @return InvoiceIsseudOverview
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @return CreditNoteReceivedOverview
     */
    public function getCreditnote()
    {
        return $this->creditnote;
    }

    /**
     * @return bool
     */
    public function isEet()
    {
        return $this->eet;
    }


}
