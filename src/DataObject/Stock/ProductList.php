<?php

namespace IUcto\DataObject\Stock;


use IUcto\Core\DataList;
use IUcto\Core\Paginator;
use IUcto\Dto\ProductOverview;

/**
 * @template TKey of int
 * @template TValue of ProductOverview
 * @implements DataList<TKey, TValue>
 */
class ProductList extends DataList
{

    /** @var array<TKey, TValue> */
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
     * @return array<TKey, TValue>
     */
    public function getRecords()
    {
        return $this->products;
    }
}
