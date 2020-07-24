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

    /** @var Supplier|null */
    public $supplier = null;

    /**  @var Customer|null */
    public $customer = null;

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

        if (array_key_exists('supplier', $arrayData) && $arrayData['supplier'] !== null) {
            $this->supplier = new Supplier($arrayData['supplier']);
        }

        if (array_key_exists('customer', $arrayData) && $arrayData['customer'] !== null) {
            $this->customer = new Customer($arrayData['customer']);
        }

        $this->departmentId = Utils::getValueOrNull($arrayData, 'department_id');
        $this->contractId = Utils::getValueOrNull($arrayData, 'contract_id');
        $this->docVariableSymbol = Utils::getValueOrNull($arrayData, 'document_variable_symbol');
        $this->docMaturityDate = Utils::getValueOrNull($arrayData, 'document_maturity_date');
        $this->itemVariableSymbol = Utils::getValueOrNull($arrayData, 'item_variable_symbol');
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
