<?php

namespace IUcto\DataObject\Contact;


use IUcto\Core\DataList;
use IUcto\Core\Paginator;
use IUcto\Dto\SupplierOverview;


class SupplierList extends DataList
{

    /** @var SupplierOverview[] */
    protected $suppliers = [];

    public function __construct(Paginator $paginator, array $suppliers)
    {
        parent::__construct($paginator);

        foreach ($suppliers as $supplier) {
            if (isset($supplier['href'])) {
                continue;
            }
            $supplierOverview = new SupplierOverview($supplier);
            $this->suppliers[$supplierOverview->getId()] = $supplierOverview;
        }
    }

    /**
     * @return SupplierOverview[]
     */
    public function getRecords()
    {
        return $this->suppliers;
    }
}
