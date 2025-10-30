<?php

namespace IUcto\DataObject\Stock;


use IUcto\Core\DataList;
use IUcto\Core\Paginator;
use IUcto\Dto\ProductOverview;

/**
 * @extends DataList<int, ProductOverview>
 */
class ProductList extends DataList
{

    /** @var array<int, ProductOverview> */
    protected $products = [];

    public function __construct(Paginator $paginator, array $productsData)
    {
        parent::__construct($paginator);

        foreach ($productsData as $productData) {
            if (isset($productData['href'])) {
                continue;
            }
            $paymentOverview = new ProductOverview($productData);
            $this->products[$paymentOverview->getId()] = $paymentOverview;
        }
    }

    /**
     * @return array<int, ProductOverview>
     */
    public function getRecords()
    {
        return $this->products;
    }
}
