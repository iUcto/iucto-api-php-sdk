<?php

namespace IUcto\DataObject\Contact;


use IUcto\Core\DataList;
use IUcto\Core\Paginator;
use IUcto\Dto\SupplierOverview;


/**
 * @extends DataList<int, SupplierOverview>
 */
class SupplierList extends DataList
{

    /** @var array<int, SupplierOverview> */
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
     * @return array<int, SupplierOverview>
     */
    public function getRecords()
    {
        return $this->suppliers;
    }
}
