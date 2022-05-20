<?php

namespace IUcto\DataObject\Payment;


use IUcto\Core\DataList;
use IUcto\Core\Paginator;
use IUcto\Dto\PaymentIssuedOverview;

/**
 * @template TKey of int
 * @template TValue of PaymentIssuedOverview
 * @implements  DataList<TKey, TValue>
 */
class PaymentIssuedList extends DataList
{

    /** @var array<TKey, TValue> */
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
     * @return array<TKey, TValue>
     */
    public function getRecords()
    {
        return $this->payments;
    }
}
