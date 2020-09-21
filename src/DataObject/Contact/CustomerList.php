<?php

namespace IUcto\DataObject\Contact;


use IUcto\Core\DataList;
use IUcto\Core\Paginator;
use IUcto\Dto\CustomerOverview;

class CustomerList extends DataList
{

    /** @var CustomerOverview[] */
    protected $customers = [];

    public function __construct(Paginator $paginator, array $customers)
    {
        parent::__construct($paginator);

        foreach ($customers as $customer) {
            if (isset($customer['href'])) {
                continue;
            }
            $customerOverview = new CustomerOverview($customer);
            $this->customers[$customerOverview->getId()] = $customerOverview;
        }
    }

    /**
     * @return CustomerOverview[]
     */
    public function getRecords()
    {
        return $this->customers;
    }
}
