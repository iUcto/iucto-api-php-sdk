<?php

namespace IUcto\DataObject\Payment;


use IUcto\Core\DataList;
use IUcto\Core\Paginator;
use IUcto\Dto\PaymentIssuedOverview;

/**
 * @extends DataList<int, PaymentIssuedOverview>
 */
class PaymentIssuedList extends DataList
{

    /** @var array<int, PaymentIssuedOverview> */
    protected $payments = [];

    public function __construct(Paginator $paginator, array $payments)
    {
        parent::__construct($paginator);

        foreach ($payments as $payment) {
            if (isset($payment['href'])) {
                continue;
            }
            $paymentOverview = new PaymentIssuedOverview($payment);
            $this->payments[$paymentOverview->getId()] = $paymentOverview;
        }
    }

    /**
     * @return array<int, PaymentIssuedOverview>
     */
    public function getRecords()
    {
        return $this->payments;
    }
}
