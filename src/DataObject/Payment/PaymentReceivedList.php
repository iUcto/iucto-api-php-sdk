<?php

namespace IUcto\DataObject\Payment;


use IUcto\Core\DataList;
use IUcto\Core\Paginator;
use IUcto\Dto\PaymentReceivedOverview;

/**
 * @extends DataList<int, PaymentReceivedOverview>
 */
class PaymentReceivedList extends DataList
{

    /** @var array<int, PaymentReceivedOverview> */
    protected $payments = [];

    public function __construct(Paginator $paginator, array $payments)
    {
        parent::__construct($paginator);

        foreach ($payments as $payment) {
            if (isset($payment['href'])) {
                continue;
            }
            $paymentOverview = new PaymentReceivedOverview($payment);
            $this->payments[$paymentOverview->getId()] = $paymentOverview;
        }
    }

    /**
     * @return array<int, PaymentReceivedOverview>
     */
    public function getRecords()
    {
        return $this->payments;
    }
}
