<?php

namespace IUcto\Command;

use IUcto;
use IUcto\Utils;

/**
 * @author iucto.cz
 */
class SavePaymentReceived extends SavePayment
{

    /**
     * ID zálohové faktury vydané
     * @var int|null
     */
    protected $proformaInvoiceId;

    /**
     * ID opravného daňového dokladu přijaté
     * @var int|null
     */
    protected $creditnoteId;

    /**
     * @var bool|null
     */
    protected $eet;

    /**
     * @var int|null
     */
    protected $eetListId;

    public function __construct(array $dataArray = [])
    {
        parent::__construct($dataArray);

        if (empty($dataArray)) {
            return;
        }

        $this->proformaInvoiceId = Utils::getValueOrNull($dataArray, 'proforma_invoice_id');
        $this->creditnoteId = Utils::getValueOrNull($dataArray, 'creditnote_received_id');
        $this->eet = Utils::getValueOrNull($dataArray, 'eet');
        $this->eetListId = Utils::getValueOrNull($dataArray, 'eet_list_id');
    }

    public function toArray()
    {
        $array = parent::toArray();

        $array['proforma_invoice_id'] = $this->proformaInvoiceId;
        $array['creditnote_received_id'] = $this->creditnoteId;
        $array['eet'] = $this->eet;
        $array['eet_list_id'] = $this->eetListId;
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

    /**
     * @return bool|null
     */
    public function getEet()
    {
        return $this->eet;
    }

    /**
     * @param bool|null $eet
     */
    public function setEet($eet)
    {
        $this->eet = $eet;
    }

    /**
     * @return int|null
     */
    public function getEetListId()
    {
        return $this->eetListId;
    }

    /**
     * @param int|null $eetListId
     */
    public function setEetListId($eetListId)
    {
        $this->eetListId = $eetListId;
    }
}
