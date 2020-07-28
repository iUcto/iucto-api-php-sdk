<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for DirectAccountingItemBase data
 *
 * @author iucto.cz
 */
class DirectAccountingItemDetail extends DirectAccountingItemBase
{
    /**
     * Cena za jednotku v CZK
     *
     * @var float(12,2)
     */
    private $priceCzk;

    /**
     * Dodavatel
     *
     * @var Supplier|null
     */
    private $supplier = null;

    /**
     * Zákazník
     *
     * @var Customer|null
     */
    private $customer = null;

    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);

        $this->priceCzk = Utils::getValueOrNull($arrayData, 'price_czk');
        if (array_key_exists('supplier', $arrayData)) {
            $this->supplier = new Supplier($arrayData['supplier']);
        }
        if (array_key_exists('customer', $arrayData)) {
            $this->supplier = new Customer($arrayData['customer']);
        }
    }

    /**
     * @return float
     */
    public function getPriceCzk()
    {
        return $this->priceCzk;
    }

    /**
     * @return Supplier|null
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer()
    {
        return $this->customer;
    }


}
