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
    protected $parentDocumentId;

    /** @var null|string */
    protected $parentDocumentType;

    /** @var string */
    protected $dateExpense;

    /** @var int */
    protected $vat;

    /** @var int */
    protected $vatTypeId;

    /** @var string */
    protected $figure;

    /** @var Supplier|null */
    protected $supplier = null;

    /**  @var Customer|null */
    protected $customer = null;

    /** @var int|null */
    protected $departmentId;

    /** @var int|null */
    protected $contractId;

    /** @var string */
    protected $documentVariableSymbol;

    /** @var string */
    protected $documentMaturityDate;

    /** @var string */
    protected $itemVariableSymbol;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);

        if (empty($arrayData)) return;

        $this->parentDocumentId = Utils::getValueOrNull($arrayData, 'parent_document_id');
        $this->parentDocumentType = Utils::getValueOrNull($arrayData, 'parent_document_type');
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
        $this->documentVariableSymbol = Utils::getValueOrNull($arrayData, 'document_variable_symbol');
        $this->documentMaturityDate = Utils::getValueOrNull($arrayData, 'document_maturity_date');
        $this->itemVariableSymbol = Utils::getValueOrNull($arrayData, 'item_variable_symbol');
    }

    /**
     * @return int|null
     */
    public function getParentDocumentId()
    {
        return $this->parentDocumentId;
    }

    /**
     * @return string|null
     */
    public function getParentDocumentType()
    {
        return $this->parentDocumentType;
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
    public function getDocumentVariableSymbol()
    {
        return $this->documentVariableSymbol;
    }

    /**
     * @return string
     */
    public function getDocumentMaturityDate()
    {
        return $this->documentMaturityDate;
    }

    /**
     * @return string
     */
    public function getItemVariableSymbol()
    {
        return $this->itemVariableSymbol;
    }


}
