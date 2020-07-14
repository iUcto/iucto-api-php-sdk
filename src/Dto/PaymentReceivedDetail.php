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
     * @var bool|null
     */
    protected $eet;

    /**
     * @var array|null
     */
    protected $eetListId;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        parent::__construct($arrayData);

        $this->proformaInvoiceId = Utils::getValueOrNull($arrayData, 'proforma_invoice_received_id');

        $this->eet = Utils::getValueOrNull($arrayData, 'eet');
        $this->eetListId = Utils::getValueOrNull($arrayData, 'eet_list_id');
    }

    /**
     * @return int|null
     */
    public function getProformaInvoiceId()
    {
        return $this->proformaInvoiceId;
    }

    /**
     * @return bool|null
     */
    public function getEet()
    {
        return $this->eet;
    }

    /**
     * @return array|null
     */
    public function getEetListId()
    {
        return $this->eetListId;
    }


}
