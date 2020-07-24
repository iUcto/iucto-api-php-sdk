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
    public $parent_id = null;

    /** @var null|string */
    public $parent_doc_type = null;

    /** @var string */
    public $date_expense;

    /** @var int */
    public $vat;

    /** @var int */
    public $vat_type_id;

    /** @var string */
    public $figure;

    /** @var null|int */
    public $supplier_id = null;

    /**  @var int */
    public $customer_id = null;

    /** @var int */
    public $department_id = null;

    /** @var int */
    public $contract_id = null;

    /** @var string */
    public $doc_variable_symbol;

    /** @var string */
    public $doc_maturity_date;

    /** @var string */
    public $item_variable_symbol;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);

        if (empty($arrayData)) return;

        $this->parent_id = Utils::getValueOrNull($arrayData, 'parent_id');
        $this->parent_doc_type = Utils::getValueOrNull($arrayData, 'parent_doc_type');
        $this->date_expense = Utils::getValueOrNull($arrayData, 'date_expense');
        $this->vat = Utils::getValueOrNull($arrayData, 'vat');
        $this->vat_type_id = Utils::getValueOrNull($arrayData, 'vat_type_id');
        $this->figure = Utils::getValueOrNull($arrayData, 'figure');
        $this->supplier_id = Utils::getValueOrNull($arrayData, 'supplier_id');
        $this->customer_id = Utils::getValueOrNull($arrayData, 'customer_id');
        $this->department_id = Utils::getValueOrNull($arrayData, 'department_id');
        $this->contract_id = Utils::getValueOrNull($arrayData, 'contract_id');
        $this->doc_variable_symbol = Utils::getValueOrNull($arrayData, 'doc_variable_symbol');
        $this->doc_maturity_date = Utils::getValueOrNull($arrayData, 'doc_maturity_date');
        $this->item_variable_symbol = Utils::getValueOrNull($arrayData, 'item_variable_symbol');
    }


    public function toArray()
    {
        $array = parent::toArray();
        return $array + [
                'parent_id' => $this->parent_id,
                'parent_doc_type' => $this->parent_doc_type,
                'date_expense' => $this->date_expense,
                'vat' => $this->vat,
                'vat_type_id' => $this->vat_type_id,
                'figure' => $this->figure,
                'supplier_id' => $this->supplier_id,
                'customer_id' => $this->customer_id,
                'department_id' => $this->department_id,
                'contract_id' => $this->contract_id,
                'doc_variable_symbol' => $this->doc_variable_symbol,
                'doc_maturity_date' => $this->doc_maturity_date,
                'item_variable_symbol' => $this->item_variable_symbol,
            ];
    }

    /**
     * @return int|null
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @return string|null
     */
    public function getParentDocType()
    {
        return $this->parent_doc_type;
    }

    /**
     * @return string
     */
    public function getDateExpense()
    {
        return $this->date_expense;
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
        return $this->vat_type_id;
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
        return $this->supplier_id;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @return int
     */
    public function getDepartmentId()
    {
        return $this->department_id;
    }

    /**
     * @return int
     */
    public function getContractId()
    {
        return $this->contract_id;
    }

    /**
     * @return string
     */
    public function getDocVariableSymbol()
    {
        return $this->doc_variable_symbol;
    }

    /**
     * @return string
     */
    public function getDocMaturityDate()
    {
        return $this->doc_maturity_date;
    }

    /**
     * @return string
     */
    public function getItemVariableSymbol()
    {
        return $this->item_variable_symbol;
    }
}
