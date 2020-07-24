<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for JournalDetail data
 *
 * @author iucto.cz
 */
class JournalDetail extends JournalOverview
{
    /** @var null|int */
    public $parentId;

    /** @var null|string */
    public $parentDocType;

    /** @var string */
    public $dateExpense;

    /** @var int */
    public $vat;

    /** @var int */
    public $vatTypeId;

    /** @var string */
    public $figure;

    /** @var null|int */
    public $supplierId;

    /**  @var int|null */
    public $customerId;

    /** @var int|null */
    public $departmentId;

    /** @var int|null */
    public $contractId;

    /** @var string */
    public $docVariableSymbol;

    /** @var string */
    public $docMaturityDate;

    /** @var string */
    public $itemVariableSymbol;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);

        if (empty($arrayData)) return;

        $this->parentId = Utils::getValueOrNull($arrayData, 'parent_document_id');
        $this->parentDocType = Utils::getValueOrNull($arrayData, 'parent_document_type');
        $this->dateExpense = Utils::getValueOrNull($arrayData, 'date_expense');
        $this->vat = Utils::getValueOrNull($arrayData, 'vat');
        $this->vatTypeId = Utils::getValueOrNull($arrayData, 'vat_type_id');
        $this->figure = Utils::getValueOrNull($arrayData, 'figure');
        $this->supplierId = Utils::getValueOrNull($arrayData, 'supplier_id');
        $this->customerId = Utils::getValueOrNull($arrayData, 'customer_id');
        $this->departmentId = Utils::getValueOrNull($arrayData, 'department_id');
        $this->contractId = Utils::getValueOrNull($arrayData, 'contract_id');
        $this->docVariableSymbol = Utils::getValueOrNull($arrayData, 'document_variable_symbol');
        $this->docMaturityDate = Utils::getValueOrNull($arrayData, 'document_maturity_date');
        $this->itemVariableSymbol = Utils::getValueOrNull($arrayData, 'item_variable_symbol');
    }


    public function toArray()
    {
        $array = parent::toArray();
        return $array + [
                'parent_document_id' => $this->parentId,
                'parent_document_type' => $this->parentDocType,
                'date_expense' => $this->dateExpense,
                'vat' => $this->vat,
                'vat_type_id' => $this->vatTypeId,
                'figure' => $this->figure,
                'supplier_id' => $this->supplierId,
                'customer_id' => $this->customerId,
                'department_id' => $this->departmentId,
                'contract_id' => $this->contractId,
                'document_variable_symbol' => $this->docVariableSymbol,
                'document_maturity_date' => $this->docMaturityDate,
                'item_variable_symbol' => $this->itemVariableSymbol,
            ];
    }

    /**
     * @return int|null
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @return string|null
     */
    public function getParentDocType()
    {
        return $this->parentDocType;
    }

    /**
     * @return string
     */
    public function getDateExpense()
    {
        return $this->dateExpense;
    }

    /**
     * @return int
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @return int
     */
    public function getVatTypeId()
    {
        return $this->vatTypeId;
    }

    /**
     * @return string
     */
    public function getFigure()
    {
        return $this->figure;
    }

    /**
     * @return int|null
     */
    public function getSupplierId()
    {
        return $this->supplierId;
    }

    /**
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @return int|null
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * @return int|null
     */
    public function getContractId()
    {
        return $this->contractId;
    }

    /**
     * @return string
     */
    public function getDocVariableSymbol()
    {
        return $this->docVariableSymbol;
    }

    /**
     * @return string
     */
    public function getDocMaturityDate()
    {
        return $this->docMaturityDate;
    }

    /**
     * @return string
     */
    public function getItemVariableSymbol()
    {
        return $this->itemVariableSymbol;
    }


}
