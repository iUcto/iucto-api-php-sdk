<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for DirectAccountingItemSave data
 *
 * @author iucto.cz
 */
class DirectAccountingItemSave extends DirectAccountingItemBase
{

    /**
     * Dodavatel
     *
     * @var int|null
     */
    private $supplierId = null;

    /**
     * Zákazník
     *
     * @var int|null
     */
    private $customerId = null;

    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);

        $this->supplierId = Utils::getValueOrNull($arrayData, 'supplier_id');
        $this->customerId = Utils::getValueOrNull($arrayData, 'customer_id');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'text' => $this->text,
            'chartaccount_md' => $this->chartAccountMd,
            'chartaccount_dal' => $this->chartAccountDal,
            'department_id' => $this->departmentId,
            'contract_id' => $this->contractId,
            'supplier_id' => $this->supplierId,
            'customer_id' => $this->customerId,
            'da_code' => $this->daCode,
        ];
    }

    /**
     * @return int|null
     */
    public function getSupplierId()
    {
        return $this->supplierId;
    }

    /**
     * @param int|null $supplierId
     */
    public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;
    }

    /**
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param int|null $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }


}
