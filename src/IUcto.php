<?php

namespace IUcto;

use IUcto\Command\PayDocument;
use IUcto\Command\SaveBankAccount;
use IUcto\Command\SaveBankTransaction;
use IUcto\Command\SaveCreditNoteIssued;
use IUcto\Command\SaveCreditNoteReceived;
use IUcto\Command\SaveCustomer;
use IUcto\Command\SaveEetStatus;
use IUcto\Command\SaveInventory;
use IUcto\Command\SaveDepartment;
use IUcto\Command\SaveDirectAccounting;
use IUcto\Command\SaveContact;
use IUcto\Command\SaveInvoiceIssued;
use IUcto\Command\SaveInvoiceReceived;
use IUcto\Command\SaveOrderIssued;
use IUcto\Command\SaveOrderReceived;
use IUcto\Command\SavePayment;
use IUcto\Command\SaveProduct;
use IUcto\Command\SaveStockMovement;
use IUcto\Command\SaveSupplier;
use IUcto\Command\SaveWarehouse;
use IUcto\Command\SaveProformaInvoiceReceived;
use IUcto\Command\SaveProformaInvoiceIssued;
use IUcto\Dto\BankAccount;
use IUcto\Dto\BankAccountList;
use IUcto\Dto\BankTransactionList;
use IUcto\Dto\BankTransactionOverview;
use IUcto\Dto\BusinessPremisesDetail;
use IUcto\Dto\BusinessPremisesOverview;
use IUcto\Dto\CashRegisterList;
use IUcto\Dto\Contract;
use IUcto\Dto\CreditNoteIsseudOverview;
use IUcto\Dto\CreditNoteIssuedDetail;
use IUcto\Dto\CreditNoteReceivedDetail;
use IUcto\Dto\CreditNoteReceivedOverview;
use IUcto\Dto\Customer;
use IUcto\Dto\CustomerOverview;
use IUcto\Dto\CustomerGroup;
use IUcto\Dto\Department;
use IUcto\Dto\DirectAccountingDetail;
use IUcto\Dto\DirectAccountingOverview;
use IUcto\Dto\EetStatusDetail;
use IUcto\Dto\EetStatusOverview;
use IUcto\Dto\InventoryDetail;
use IUcto\Dto\InvoiceIsseudOverview;
use IUcto\Dto\InvoiceIssuedDetail;
use IUcto\Dto\InvoiceReceivedDetail;
use IUcto\Dto\InvoiceReceivedOverview;
use IUcto\Dto\JournalDetail;
use IUcto\Dto\JournalOverview;
use IUcto\Dto\OrderIssuedDetail;
use IUcto\Dto\OrderIssuedOverview;
use IUcto\Dto\OrderReceivedDetail;
use IUcto\Dto\OrderReceivedOverview;
use IUcto\Dto\PaymentIssuedDetail;
use IUcto\Dto\PaymentIssuedOverview;
use IUcto\Dto\PaymentReceivedDetail;
use IUcto\Dto\PaymentReceivedOverview;
use IUcto\Dto\ProductDetail;
use IUcto\Dto\ProductOverview;
use IUcto\Dto\StockMovementDetail;
use IUcto\Dto\StockMovementOverview;
use IUcto\Dto\Supplier;
use IUcto\Dto\SupplierOverview;
use IUcto\Dto\SupplierGroup;
use IUcto\Dto\ProformaInvoiceReceivedOverview;
use IUcto\Dto\ProformaInvoiceReceivedDetail;
use IUcto\Dto\ProformaInvoiceIssuedOverview;
use IUcto\Dto\ProformaInvoiceIssuedDetail;
use IUcto\Dto\WarehouseDetail;


/**
 * @author iucto.cz
 */
class IUcto
{

    private $connector;
    private $parser;
    private $errorHandler;

    public function __construct(Connector $connector, Parser $parser, ErrorHandler $errorHandler)
    {
        $this->connector = $connector;
        $this->parser = $parser;
        $this->errorHandler = $errorHandler;
    }


    /**
     * @param $address
     * @param $method
     * @param array $data
     * @return array|mixed|mixed[]|null
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    private function handleRequest($address, $method, array $data = array())
    {
        try {
            $response = $this->connector->request($address, $method, $data);
            if ($method == Connector::DELETE) {
                return $response;
            }
            return $this->parser->parse($response);
        } catch (BadRequestException $ex) {
            if (!empty($ex->getResponseData())) {
                $data = $this->parser->parse($ex->getResponseData());
                if (isset($data['errors']) && is_array($data['errors'])) {
                    throw new ValidationException('Neplatný požadavek', $ex->getCode(), $ex, $data['errors']);
                }
            }
            throw $ex;
        }
    }

    /**
     * @param $address
     * @param $method
     * @param array $data
     * @return array|mixed|mixed[]|null
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    private function handleDownloadRequest($address, $method, array $data = array())
    {
        try {
            return $this->connector->request($address, $method, $data);
        } catch (BadRequestException $ex) {
            if (!empty($ex->getResponseData())) {
                $data = $this->parser->parse($ex->getResponseData());
                if (isset($data['errors']) && is_array($data['errors'])) {
                    throw new ValidationException('Neplatný požadavek', $ex->getCode(), $ex, $data['errors']);
                }
            }
            throw $ex;
        }
    }

    /**
     * Zjednodušený výpis všech dostupných dokladů.
     *
     * @return InvoiceIsseudOverview[] - 2-úrovňové pole. První úroveň tvoří klíč typ dokladu.
     * @throws ConnectionException
     * @throws ValidationException
     * @deprecated
     */
    public function getAllInvoiceIssued()
    {
        $allData = $this->handleRequest('invoice_issued', Connector::GET);
        $allDocuments = array();
        foreach ($allData as $type => $typeData) {
            foreach ($typeData as $data) {
                if (isset($data['href'])) {
                    continue;
                }
                $allDocuments[$type][] = new InvoiceIsseudOverview($data);
            }
        }
        return $allDocuments;
    }

    /**
     * Zjednodušený výpis dostupných dokladů.
     *
     * @param int|null $page
     * @param int|null $pageSize
     * @return InvoiceIsseudOverview[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getInvoiceIssued($page = null, $pageSize = null, $filters = [])
    {
        if (isset($page) && isset($pageSize)) {
            $filters['page'] = $page;
            $filters['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('invoice_issued', Connector::GET, $filters);
        $pageCount = isset($allData[Parser::PAGE_COUNT]) ? $allData[Parser::PAGE_COUNT] : 1;
        if (isset($allData[Parser::PAGE_COUNT])) {
            unset($allData[Parser::PAGE_COUNT]);
        }
        $allDocuments = array();
        $allDocuments[Parser::PAGE_COUNT] = $pageCount;
        foreach ($allData as $type => $typeData) {
            foreach ($typeData as $data) {
                if (isset($data['href'])) {
                    continue;
                }
                $allDocuments[$type][] = new InvoiceIsseudOverview($data);
            }
        }
        return $allDocuments;
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getInvoiceIssuedPdf($id)
    {
        return $this->handleDownloadRequest('invoice_issued/' . $id . '/pdf', Connector::GET);
    }

    /**
     * Vytvoří nový doklad, odpověd obsahuje detail dokladu.
     *
     * @param SaveInvoiceIssued $saveDocument
     * @return InvoiceIssuedDetail
     * @throws \IUcto\ConnectionException
     * @throws \IUcto\ValidationException
     */
    public function createInvoiceIssued(SaveInvoiceIssued $saveDocument)
    {
        $allData = $this->handleRequest('invoice_issued', Connector::POST, $saveDocument->toArray());
        return new InvoiceIssuedDetail($allData);
    }

    /**
     * Vrátí kompletní kolekci dat vybraného dokladu.
     *
     * @param int $id
     * @return InvoiceIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getInvoiceIssuedDetail($id)
    {
        $allData = $this->handleRequest('invoice_issued/' . $id, Connector::GET);
        return new InvoiceIssuedDetail($allData);
    }

    /**
     * Aktulizuje předané parametry vybraného dokladu. Poviné ple jsou stejná jako při vkládání nového záznamu.
     *
     * @param int $id
     * @param SaveInvoiceIssued $saveDocument
     * @return InvoiceIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateInvoiceIssued($id, SaveInvoiceIssued $saveDocument)
    {
        $allData = $this->handleRequest('invoice_issued/' . $id, Connector::PUT, $saveDocument->toArray());
        return new InvoiceIssuedDetail($allData);
    }

    /**
     * Pokusí se smazat vybraný dokladu. Pokud je doklad vázán na jiný záznam, vrátí chybu a doklad se nasmaže.
     *
     * @param int $id
     * @return void
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteInvoiceIssued($id)
    {
        $this->handleRequest('invoice_issued/' . $id, Connector::DELETE);
    }


    /**
     * Zjednodušený výpis všech dostupných dokladů.
     *
     * @return InvoiceReceivedOverview[] - 2-úrovňové pole. První úroveň tvoří klíč typ dokladu.
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getAllInvoiceReceived()
    {
        $allData = $this->handleRequest('invoice_received', Connector::GET);
        $allDocuments = array();
        foreach ($allData as $type => $typeData) {
            foreach ($typeData as $data) {
                if (isset($data['href'])) {
                    continue;
                }
                $allDocuments[$type][] = new InvoiceReceivedOverview($data);
            }
        }
        return $allDocuments;
    }

    /**
     * Zjednodušený výpis dostupných dokladů.
     *
     * @param int|null $page
     * @param int|null $pageSize
     * @return InvoiceReceivedOverview[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getInvoiceReceived($page = null, $pageSize = null, $filters = [])
    {
        if (isset($page) && isset($pageSize)) {
            $filters['page'] = $page;
            $filters['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('invoice_received', Connector::GET, $filters);
        $pageCount = isset($allData[Parser::PAGE_COUNT]) ? $allData[Parser::PAGE_COUNT] : 1;
        if (isset($allData[Parser::PAGE_COUNT])) {
            unset($allData[Parser::PAGE_COUNT]);
        }
        $allDocuments = array();
        $allDocuments[Parser::PAGE_COUNT] = $pageCount;
        foreach ($allData as $type => $typeData) {
            foreach ($typeData as $data) {
                if (isset($data['href'])) {
                    continue;
                }
                $allDocuments[$type][] = new InvoiceReceivedOverview($data);
            }
        }
        return $allDocuments;
    }

    /**
     * Vytvoří nový doklad, odpověd obsahuje detail dokladu.
     *
     * @param SaveInvoiceReceived $saveDocument
     * @return InvoiceReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createInvoiceReceived(SaveInvoiceReceived $saveDocument)
    {
        $allData = $this->handleRequest('invoice_received', Connector::POST, $saveDocument->toArray());
        return new InvoiceReceivedDetail($allData);
    }

    /**
     * Vrátí kompletní kolekci dat vybraného dokladu.
     *
     * @param int $id
     * @return InvoiceReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getInvoiceReceivedDetail($id)
    {
        $allData = $this->handleRequest('invoice_received/' . $id, Connector::GET);
        return new InvoiceReceivedDetail($allData);
    }

    /**
     * Aktulizuje předané parametry vybraného dokladu. Poviné ple jsou stejná jako při vkládání nového záznamu.
     *
     * @param int $id
     * @param SaveInvoiceReceived $saveDocument
     * @return InvoiceReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateInvoiceReceived($id, SaveInvoiceReceived $saveDocument)
    {
        $allData = $this->handleRequest('invoice_received/' . $id, Connector::PUT, $saveDocument->toArray());
        return new InvoiceReceivedDetail($allData);
    }

    /**
     * Pokusí se smazat vybraný dokladu. Pokud je doklad vázán na jiný záznam, vrátí chybu a doklad se nasmaže.
     *
     * @param int $id
     * @return void
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteInvoiceReceived($id)
    {
        $this->handleRequest('invoice_received/' . $id, Connector::DELETE);
    }

    /**
     * Zjednodušený výpis všech dostupných zákazníků.
     *
     * @return CustomerOverview []
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getCustomers($page = null, $pageSize = null, $filters = [])
    {
        if (isset($page) && isset($pageSize)) {
            $filters['page'] = $page;
            $filters['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('customer', Connector::GET, $filters);

        $allCustomers = array();
        if (isset($allData['customer'])) {
            foreach ($allData['customer'] as $customer) {
                $allCustomers[] = new CustomerOverview($customer);
            }
        }
        return $allCustomers;
    }

    /**
     * Vytvoří nový doklad, odpověd obsahuje detail vytvořeného zákazníka.
     *
     * @param SaveCustomer $saveCustomer
     * @return Customer
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createCustomer(SaveCustomer $saveCustomer)
    {
        $allData = $this->handleRequest('customer', Connector::POST, $saveCustomer->toArray());

        if (!$allData) {
            throw new \InvalidArgumentException("Can't parse the recieved data");
        }
        return new Customer($allData);
    }

    /**
     * Vrátí veškerá data k zákazníkovi.
     *
     * @param int $id
     * @return Customer
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getCustomerDetail($id)
    {
        $allData = $this->handleRequest('customer/' . $id, Connector::GET);
        return new Customer($allData);
    }

    /**
     * Aktulizuje předané parametry vybraného zákazníka. Poviné ple jsou stejná jako při vkládání nového zákazníka.
     *
     * @param int $id
     * @param SaveCustomer $saveCustomer
     * @return Customer
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateCustomer($id, SaveCustomer $saveCustomer)
    {
        $allData = $this->handleRequest('customer/' . $id, Connector::PUT, $saveCustomer->toArray());
        return new Customer($allData);
    }

    /**
     * Pokusí se smazat vybraného zákazníka. Pokud je ovšem vázán na jiný záznam (faktury, platba, apod.), vrátí chybu a zákazník se nasmaže.
     *
     * @param int $id
     * @return void
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteCustomer($id)
    {
        $this->handleRequest('customer/' . $id, Connector::DELETE);
    }

    /**
     * Výpis dostupných skupin zakázníku.
     *
     * @return CustomerGroup[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getCustomersGroup()
    {
        $allData = $this->handleRequest('customer_group', Connector::GET);

        $customers = array();
        foreach ($allData['customer_group'] as $data) {
            $customers[] = new CustomerGroup($data);
        }
        return $customers;
    }

    /**
     * @return array
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getSuppliers($page = null, $pageSize = null, $filters = [])
    {
        if (isset($page) && isset($pageSize)) {
            $filters['page'] = $page;
            $filters['pageSize'] = $pageSize;
        }

        $allData = $this->handleRequest('supplier', Connector::GET, $filters);

        $allSuppliers = array();
        if (isset($allData['supplier'])) {
            foreach ($allData['supplier'] as $supplier) {
                $allSuppliers[] = new SupplierOverview($supplier);
            }
        }
        return $allSuppliers;
    }

    /**
     * Výpis dostupných skupin dodavatelů.
     *
     * @return SupplierGroup[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getSuppliersGroup()
    {
        $allData = $this->handleRequest('supplier_group', Connector::GET);

        $suppliers = array();
        foreach ($allData['supplier_group'] as $data) {
            $suppliers[] = new SupplierGroup($data);
        }
        return $suppliers;
    }

    /**
     * Pokusi se vytvorit dodavatele
     *
     * @param SaveSupplier $saveSupplier
     * @return Supplier
     * @throws ConnectionException
     * @throws ValidationException
     */

    public function createSupplier(SaveSupplier $saveSupplier)
    {
        $allData = $this->handleRequest('supplier', Connector::POST, $saveSupplier->toArray());
        if (!$allData) {
            throw new \InvalidArgumentException("Can't parse the recieved data");
        }
        return new Supplier($allData);
    }

    /**
     * Vrátí veškerá data k dodavateli.
     *
     * @param int $id
     * @return Supplier
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getSupplierDetail($id)
    {
        $allData = $this->handleRequest('supplier/' . $id, Connector::GET);
        return new Supplier($allData);
    }

    /**
     * Aktulizuje předané parametry vybraného dodavatele. Poviné ple jsou stejná jako při vkládání nového dodavatele.
     *
     * @param int $id
     * @param SaveSupplier $saveSupplier
     * @return Supplier
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateSupplier($id, SaveSupplier $saveSupplier)
    {
        $allData = $this->handleRequest('supplier/' . $id, Connector::PUT, $saveSupplier->toArray());
        return new Supplier($allData);
    }

    /**
     * Pokusí se smazat vybraného dodavatele. Pokud je ovšem vázán na jiný záznam (faktury, platba, apod.), vrátí chybu a dodavatel se nasmaže.
     *
     * @param int $id
     * @return void
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteSupplier($id)
    {
        $this->handleRequest('supplier/' . $id, Connector::DELETE);
    }

    /**
     * Zjednodušený výpis všech vydaných plateb.
     *
     * @return PaymentReceivedOverview[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getReceivedPayments()
    {
        $allData = $this->handleRequest('payment_received', Connector::GET);
        $allDocuments = array();
        if (isset($allData["payment_received"])) {
            foreach ($allData["payment_received"] as $i => $data) {
                $allDocuments[] = new PaymentReceivedOverview($data);
            }
        }
        return $allDocuments;
    }

    /**
     * Vytvoří novú platbu, odpověd obsahuje detail platby.
     *
     * @param SavePayment $saveReceivedPayment
     * @return PaymentReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createReceivedPayment(SavePayment $saveReceivedPayment)
    {
        $allData = $this->handleRequest('payment_received', Connector::POST, $saveReceivedPayment->toArray());
        return new PaymentReceivedDetail($allData);
    }

    /**
     * @param $id
     * @param SavePayment $saveReceivedPayment
     * @return PaymentReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateReceivedPayment($id, SavePayment $saveReceivedPayment)
    {
        $allData = $this->handleRequest('payment_received/' . $id, Connector::PUT, $saveReceivedPayment->toArray());
        return new PaymentReceivedDetail($allData);
    }

    /**
     * @param $id
     * @return PaymentReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getReceivedPaymentDetail($id)
    {
        $allData = $this->handleRequest('payment_received/' . $id, Connector::GET);
        return new PaymentReceivedDetail($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteReceivedPayment($id)
    {
        $this->handleRequest('payment_received/' . $id, Connector::DELETE);
    }


    /**
     * @return PaymentIssuedOverview[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getIssuedPayments()
    {
        $allData = $this->handleRequest('payment_issued', Connector::GET);
        $allDocuments = array();
        if (isset($allData["payment_issued"])) {
            foreach ($allData["payment_issued"] as $i => $data) {
                $allDocuments[] = new PaymentIssuedOverview($data);
            }
        }
        return $allDocuments;
    }

    /**
     * @param SavePayment $saveIssuedPayment
     * @return PaymentIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createIssuedPayment(SavePayment $saveIssuedPayment)
    {
        $allData = $this->handleRequest('payment_issued', Connector::POST, $saveIssuedPayment->toArray());
        return new PaymentIssuedDetail($allData);
    }

    /**
     * @param $id
     * @param SavePayment $saveIssuedPayment
     * @return PaymentIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateIssuedPayment($id, SavePayment $saveIssuedPayment)
    {
        $allData = $this->handleRequest('payment_issued/' . $id, Connector::PUT, $saveIssuedPayment->toArray());
        return new PaymentIssuedDetail($allData);
    }

    /**
     * @param $id
     * @return PaymentIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getIssuedPaymentDetail($id)
    {
        $allData = $this->handleRequest('payment_issued/' . $id, Connector::GET);
        return new PaymentIssuedDetail($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteIssuedPayment($id)
    {
        $this->handleRequest('payment_issued/' . $id, Connector::DELETE);
    }


    /**
     * Seznam dostupných bankovních účtů.
     *
     * @return BankAccountList|array
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getBankAccounts()
    {
        $allData = $this->handleRequest('bank_account', Connector::GET);

        if (isset($allData['bank_account'])) {
            return new BankAccountList($allData['bank_account']);
        } else {
            return array();
        }
    }

    /**
     * @param SaveBankAccount $saveBankAccount
     * @return BankAccount
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createBankAccount(SaveBankAccount $saveBankAccount)
    {
        $allData = $this->handleRequest('bank_account', Connector::POST, $saveBankAccount->toArray());
        return new BankAccount($allData);
    }

    /**
     * @param $id
     * @param SaveBankAccount $saveBankAccount
     * @return BankAccount
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateBankAccount($id, SaveBankAccount $saveBankAccount)
    {
        $allData = $this->handleRequest('bank_account/' . $id, Connector::PUT, $saveBankAccount->toArray());
        return new BankAccount($allData);
    }

    /**
     * @param $id
     * @return BankAccount
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getBankAccounttDetail($id)
    {
        $allData = $this->handleRequest('bank_account/' . $id, Connector::GET);
        return new BankAccount($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteBankAccount($id)
    {
        $this->handleRequest('bank_account/' . $id, Connector::DELETE);
    }

    /**
     * @return array|CashRegisterList
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getCashRegisters()
    {
        $allData = $this->handleRequest('cash_register', Connector::GET);

        if (isset($allData['cash_register'])) {
            return new CashRegisterlist($allData['cash_register']);
        } else {
            return array();
        }
    }

    /**
     * Seznam dostupných měn pro použití v dokladech.Dostupnost se může měnit v závislosti na aktivaci rozšíření Účtování v cizích měnách.
     *
     * @return string[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getCurrencies()
    {
        return $this->handleRequest('currency', Connector::GET);
    }

    /**
     * Seznam metod pro zaokrouhlování částek v dokladech.
     *
     * @return string[]  klíč označení, hodnota popis
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getRoundingTypes()
    {
        return $this->handleRequest('rounding_type', Connector::GET);
    }

    /**
     * Seznam dostupných metod pro provedení platby používaných v dokladech.
     *
     * @return string[]  klíč označení, hodnota popis
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getPaymentTypes()
    {
        return $this->handleRequest('payment_type', Connector::GET);
    }

    /**
     * Seznam kurzů DPH k danému datu.
     *
     * @param string $date formát (YYYY-mm-dd)
     * @return int[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getVATRatesOn($date)
    {
        return $this->handleRequest('vat_rates?date=' . $date, Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných účetních položek v závislosti na parametru doctype. Formát odpovědi: {"id": "popis"}
     *
     * @param string $doctype
     * @return string[] klíč označení, hodnota popis
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getAccountingEntryTypes($doctype = "FV")
    {
        return $this->handleRequest('accountentry_type?doctype=' . $doctype, Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných typů DPH v závislosti na parametru doctype. Formát odpovědi: {"id": "popis"}
     *
     * @param string $doctype
     * @return string[] klíč označení, hodnota popis
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getVATs($doctype = "FV")
    {
        return $this->handleRequest('vat_type?doctype=' . $doctype, Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných účtů úč. osnovy pro použití v dokladech.{"id": "popis"}
     *
     * @return string[] klíč označení, hodnota popis
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getChartAccounts()
    {
        return $this->handleRequest('chart_account', Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných Účty DPH pro použití v dokladech.{"id": "popis"}
     *
     * @return mixed[] klíč (int) označení, hodnota popis
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getChartAccountVATs()
    {
        return $this->handleRequest('vat_chart', Connector::GET);
    }

    /**
     * Výpis dostupných středisek.
     *
     * @return Department[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getDepartments()
    {
        $allData = $this->handleRequest('department', Connector::GET);
        $departments = array();
        foreach ($allData['department'] as $data) {
            $departments[] = new Department($data);
        }
        return $departments;
    }

    /**
     * @param SaveDepartment $saveDepartment
     * @return Department
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createDepartment(SaveDepartment $saveDepartment)
    {
        $allData = $this->handleRequest('department', Connector::POST, $saveDepartment->toArray());
        return new Department($allData);
    }

    /**
     * @param $id
     * @param SaveDepartment $saveDepartment
     * @return Department
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateDepartment($id, SaveDepartment $saveDepartment)
    {
        $allData = $this->handleRequest('department/' . $id, Connector::PUT, $saveDepartment->toArray());
        return new Department($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteDepartment($id)
    {
        $this->handleRequest('department/' . $id, Connector::DELETE);
    }

    /**
     * Výpis dostupných zakázek.
     *
     * @return Contract[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getContracts()
    {
        $allData = $this->handleRequest('contract', Connector::GET);
        $contracts = array();
        foreach ($allData['contract'] as $data) {
            $contracts[] = new Contract($data);
        }
        return $contracts;
    }

    /**
     * @param SaveContract $saveContract
     * @return Contract
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createContract(SaveContract $saveContract)
    {
        $allData = $this->handleRequest('contract', Connector::POST, $saveContract->toArray());
        return new Contract($allData);
    }

    /**
     * @param $id
     * @param SaveContract $saveContract
     * @return Contract
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateContract($id, SaveContract $saveContract)
    {
        $allData = $this->handleRequest('contract/' . $id, Connector::PUT, $saveContract->toArray());
        return new Contract($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteContract($id)
    {
        $this->handleRequest('contract/' . $id, Connector::DELETE);
    }

    /**
     * Seznam dostupných metod.
     *
     * @return string[] klíč označení, hodnota popis
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getPreferedPaymentMethods()
    {
        return $this->handleRequest('preferred_payment_method', Connector::GET);
    }

    /**
     * Seznam dostupných států.
     *
     * @return string[] klíč označení, hodnota popis
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getCountries()
    {
        return $this->handleRequest('country', Connector::GET);
    }

    /**
     * Seznam bankovních transakcí
     * @return BankTransactionList[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getBankTransactionList()
    {
        $allData = $this->handleRequest('bank_transaction', Connector::GET);
        $transactions = [];
        if (isset($allData["bank_transaction"])) {
            foreach ($allData["bank_transaction"] as $i => $data) {
                $transactions[] = new BankTransactionList($data);
            }
        }
        return $transactions;
    }

    /**
     * @param SaveBankTransaction $saveBankTransaction
     * @return BankTransactionOverview
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createBankTransaction(SaveBankTransaction $saveBankTransaction)
    {
        $allData = $this->handleRequest('bank_transaction', Connector::POST, $saveBankTransaction->toArray());
        return new BankTransactionOverview($allData);
    }

    /**
     * @param $id
     * @param SaveBankTransaction $bankTransaction
     * @return BankTransactionOverview
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateBankTransaction($id, SaveBankTransaction $bankTransaction)
    {
        $allData = $this->handleRequest('bank_transaction/' . $id, Connector::PUT, $bankTransaction->toArray());
        return new BankTransactionOverview($allData);
    }

    /**
     * @param $id
     * @return BankTransactionOverview
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getBankTransactionDetail($id)
    {
        $allData = $this->handleRequest('bank_transaction/' . $id, Connector::GET);
        return new BankTransactionOverview($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteBankTransaction($id)
    {
        $this->handleRequest('bank_transaction/' . $id, Connector::DELETE);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function bankTransactionAccount($id)
    {
        $this->handleRequest('bank_transaction/' . $id . '/account', Connector::PUT);
    }

    /**
     * Seznam objednávek vydaných
     * @return OrderIssuedOverview[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getOrderIssuedList()
    {
        $allData = $this->handleRequest('order_issued', Connector::GET);
        $ordersIssued = [];
        if (isset($allData["order_issued"])) {
            foreach ($allData["order_issued"] as $i => $data) {
                $ordersIssued[] = new OrderIssuedOverview($data);
            }
        }
        return $ordersIssued;
    }

    /**
     * @param SaveOrderIssued $saveOrderIssued
     * @return OrderIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createOrderIssued(SaveOrderIssued $saveOrderIssued)
    {
        $allData = $this->handleRequest('order_issued', Connector::POST, $saveOrderIssued->toArray());
        return new OrderIssuedDetail($allData);
    }

    /**
     * @param $id
     * @param SaveOrderIssued $saveOrderIssued
     * @return OrderIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateOrderIssued($id, SaveOrderIssued $saveOrderIssued)
    {
        $allData = $this->handleRequest('order_issued/' . $id, Connector::PUT, $saveOrderIssued->toArray());
        return new OrderIssuedDetail($allData);
    }

    /**
     * @param $id
     * @return OrderIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getOrderIssuedDetail($id)
    {
        $allData = $this->handleRequest('order_issued/' . $id, Connector::GET);
        return new OrderIssuedDetail($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteOrderIssued($id)
    {
        $this->handleRequest('order_issued/' . $id, Connector::DELETE);
    }

    /**
     * Seznam objednávek vydaných
     * @return OrderIssuedOverview[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getOrderReceivedList()
    {
        $allData = $this->handleRequest('order_received', Connector::GET);
        $ordersIssued = [];
        if (isset($allData["order_received"])) {
            foreach ($allData["order_received"] as $i => $data) {
                $ordersIssued[] = new OrderReceivedOverview($data);
            }
        }
        return $ordersIssued;
    }

    /**
     * @param SaveOrderReceived $saveOrderReceived
     * @return OrderReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createOrderReceived(SaveOrderReceived $saveOrderReceived)
    {
        $allData = $this->handleRequest('order_received', Connector::POST, $saveOrderReceived->toArray());
        return new OrderReceivedDetail($allData);
    }

    /**
     * @param $id
     * @param SaveOrderReceived $saveOrderReceived
     * @return OrderReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateOrderReceived($id, SaveOrderReceived $saveOrderReceived)
    {
        $allData = $this->handleRequest('order_received/' . $id, Connector::PUT, $saveOrderReceived->toArray());
        return new OrderReceivedDetail($allData);
    }

    /**
     * @param $id
     * @return OrderReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getOrderReceivedDetail($id)
    {
        $allData = $this->handleRequest('order_received/' . $id, Connector::GET);
        return new OrderReceivedDetail($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteOrderReceived($id)
    {
        $this->handleRequest('order_received/' . $id, Connector::DELETE);
    }


    /**
     * Seznam dobropisů vydaných
     * @return CreditNoteIssuedOverview[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getCreditNoteIssuedList()
    {
        $allData = $this->handleRequest('creditnote_issued', Connector::GET);
        $creditNoteIssued = [];
        if (isset($allData["creditnote_issued"])) {
            foreach ($allData["creditnote_issued"] as $i => $data) {
                $creditNoteIssued[] = new CreditNoteIsseudOverview($data);
            }
        }
        return $creditNoteIssued;
    }

    /**
     * @param SaveCreditNoteIssued $saveCreditNoteIssued
     * @return CreditNoteIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createCreditNoteIssued(SaveCreditNoteIssued $saveCreditNoteIssued)
    {
        $allData = $this->handleRequest('creditnote_issued', Connector::POST, $saveCreditNoteIssued->toArray());
        return new CreditNoteIssuedDetail($allData);
    }

    /**
     * @param $id
     * @param SaveCreditNoteIssued $saveCreditNoteIssued
     * @return CreditNoteIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateCreditNoteIssued($id, SaveCreditNoteIssued $saveCreditNoteIssued)
    {
        $allData = $this->handleRequest('creditnote_issued/' . $id, Connector::PUT, $saveCreditNoteIssued->toArray());
        return new CreditNoteIssuedDetail($allData);
    }

    /**
     * @param $id
     * @return CreditNoteIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getCreditNoteIssuedDetail($id)
    {
        $allData = $this->handleRequest('creditnote_issued/' . $id, Connector::GET);
        return new CreditNoteIssuedDetail($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteCreditNoteIssued($id)
    {
        $this->handleRequest('creditnote_issued/' . $id, Connector::DELETE);
    }

    /**
     * Zjednodušený výpis dostupných dokladů.
     *
     * @param int|null $page
     * @param int|null $pageSize
     * @return ProformaInvoiceReceivedOverview[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getProformaInvoiceReceived($page = null, $pageSize = null)
    {
        $filters = array();
        if (isset($page) && isset($pageSize)) {
            $filters['page'] = $page;
            $filters['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('proforma_invoice_received', Connector::GET, $filters);
        $pageCount = isset($allData[Parser::PAGE_COUNT]) ? $allData[Parser::PAGE_COUNT] : 1;
        if (isset($allData[Parser::PAGE_COUNT])) {
            unset($allData[Parser::PAGE_COUNT]);
        }
        $allDocuments = array();
        $allDocuments[Parser::PAGE_COUNT] = $pageCount;
        foreach ($allData as $type => $typeData) {
            foreach ($typeData as $data) {
                if (isset($data['href'])) {
                    continue;
                }
                $allDocuments[$type][] = new ProformaInvoiceReceivedOverview($data);
            }
        }
        return $allDocuments;
    }

    /**
     * @param $id
     * @return ProformaInvoiceReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getProformaInvoiceReceivedDetail($id)
    {
        $allData = $this->handleRequest('proforma_invoice_received/' . $id, Connector::GET);
        return new ProformaInvoiceReceivedDetail($allData);
    }

    /**
     * Vytvoří nový doklad, odpověd obsahuje detail dokladu.
     *
     * @param SaveProformaInvoiceReceived $saveDocument
     * @return ProformaInvoiceReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createProformaInvoiceReceived(SaveProformaInvoiceReceived $saveDocument)
    {
        $allData = $this->handleRequest('proforma_invoice_received', Connector::POST, $saveDocument->toArray());
        return new ProformaInvoiceReceivedDetail($allData);
    }

    /**
     * Aktulizuje předané parametry vybraného dokladu. Poviné pole jsou stejná jako při vkládání nového záznamu.
     *
     * @param int $id
     * @param SaveProformaInvoiceReceived $saveDocument
     * @return ProformaInvoiceReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateProformaInvoiceReceived($id, SaveProformaInvoiceReceived $saveDocument)
    {
        $allData = $this->handleRequest('proforma_invoice_received/' . $id, Connector::PUT, $saveDocument->toArray());
        return new ProformaInvoiceReceivedDetail($allData);
    }

    /**
     * Pokusí se smazat vybranou zálohovou fakturu. Pokud je ovšem vázán na jiný záznam (faktura, platba, apod.), vrátí chybu a faktura se nasmaže.
     *
     * @param int $id
     * @return void
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteProformaInvoiceReceived($id)
    {
        $this->handleRequest('proforma_invoice_received/' . $id, Connector::DELETE);
    }

    /**
     * Zjednodušený výpis dostupných dokladů.
     *
     * @param int|null $page
     * @param int|null $pageSize
     * @return ProformaInvoiceIssuedOverview[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getProformaInvoiceIssued($page = null, $pageSize = null)
    {
        $filters = array();
        if (isset($page) && isset($pageSize)) {
            $filters['page'] = $page;
            $filters['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('proforma_invoice_issued', Connector::GET, $filters);
        $pageCount = isset($allData[Parser::PAGE_COUNT]) ? $allData[Parser::PAGE_COUNT] : 1;
        if (isset($allData[Parser::PAGE_COUNT])) {
            unset($allData[Parser::PAGE_COUNT]);
        }
        $allDocuments = array();
        $allDocuments[Parser::PAGE_COUNT] = $pageCount;
        foreach ($allData as $type => $typeData) {
            foreach ($typeData as $data) {
                if (isset($data['href'])) {
                    continue;
                }
                $allDocuments[$type][] = new ProformaInvoiceIssuedOverview($data);
            }
        }
        return $allDocuments;
    }

    /**
     * @param $id
     * @return ProformaInvoiceIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getProformaInvoiceIssuedDetail($id)
    {
        $allData = $this->handleRequest('proforma_invoice_issued/' . $id, Connector::GET);
        return new ProformaInvoiceIssuedDetail($allData);
    }

    /**
     * Vytvoří nový doklad, odpověd obsahuje detail dokladu.
     *
     * @param SaveProformaInvoiceIssued $saveDocument
     * @return ProformaInvoiceIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createProformaInvoiceIssued(SaveProformaInvoiceIssued $saveDocument)
    {
        $allData = $this->handleRequest('proforma_invoice_issued', Connector::POST, $saveDocument->toArray());
        return new ProformaInvoiceIssuedDetail($allData);
    }

    /**
     * Aktulizuje předané parametry vybraného dokladu. Poviné pole jsou stejná jako při vkládání nového záznamu.
     *
     * @param int $id
     * @param SaveProformaInvoiceIssued $saveDocument
     * @return ProformaInvoiceIssuedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateProformaInvoiceIssued($id, SaveProformaInvoiceIssued $saveDocument)
    {
        $allData = $this->handleRequest('proforma_invoice_issued/' . $id, Connector::PUT, $saveDocument->toArray());
        return new ProformaInvoiceIssuedDetail($allData);
    }

    /**
     * Pokusí se smazat vybranou zálohovou fakturu. Pokud je ovšem vázán na jiný záznam (faktura, platba, apod.), vrátí chybu a faktura se nasmaže.
     *
     * @param int $id
     * @return void
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteProformaInvoiceIssued($id)
    {
        $this->handleRequest('proforma_invoice_issued/' . $id, Connector::DELETE);
    }
    /**
     * Seznam skladů.
     *
     * @param int|null $page
     * @param int|null $pageSize
     * @return WarehouseDetail[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getWarehouseList($page = null, $pageSize = null)
    {
        $params = [];
        if (isset($page) && isset($pageSize)) {
            $params['page'] = $page;
            $params['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('warehouse', Connector::GET, $params);
        $pageCount = $allData[Parser::PAGE_COUNT];
        unset($allData[Parser::PAGE_COUNT]);
        $allRows = array();
        $allRows[Parser::PAGE_COUNT] = $pageCount;
        $allRows['warehouse'] = [];
        foreach ($allData['warehouse'] as $data) {
            if (isset($data['href'])) {
                continue;
            }
            $warehoueDetail = new WarehouseDetail($data);
            $allRows['warehouse'][$warehoueDetail->getId()] = $warehoueDetail;
        }

        return $allRows;
    }

    /**
     * @param SaveWarehouse $saveWarehouse
     * @return WarehouseDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createWarehouse(SaveWarehouse $saveWarehouse)
    {
        $allData = $this->handleRequest('warehouse', Connector::POST, $saveWarehouse->toArray());
        return new WarehouseDetail($allData);
    }

    /**
     * @param $id
     * @param SaveWarehouse $saveWarehouse
     * @return WarehouseDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateWarehouse($id, SaveWarehouse $saveWarehouse)
    {
        $allData = $this->handleRequest('warehouse/' . $id, Connector::PUT, $saveWarehouse->toArray());
        return new WarehouseDetail($allData);
    }

    /**
     * @param $id
     * @return WarehouseDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getWarehouseDetail($id)
    {
        $allData = $this->handleRequest('warehouse/' . $id, Connector::GET);
        return new WarehouseDetail($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteWarehouse($id)
    {
        $this->handleRequest('warehouse/' . $id, Connector::DELETE);
    }


    /**
     * Seznam skladů.
     *
     * @param array $params
     * @param int|null $page
     * @param int|null $pageSize
     * @return InventoryDetail[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function getInventoryList($params = [], $page = null, $pageSize = null)
    {
        if (isset($page) && isset($pageSize)) {
            $params['page'] = $page;
            $params['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('inventory', Connector::GET, $params);
        $pageCount = $allData[Parser::PAGE_COUNT];
        unset($allData[Parser::PAGE_COUNT]);
        $allRows = array();
        $allRows[Parser::PAGE_COUNT] = $pageCount;
        $allRows['inventory'] = [];
        foreach ($allData['inventory'] as $data) {
            if (isset($data['href'])) {
                continue;
            }
            $inventoryDetail = new InventoryDetail($data);
            $allRows['inventory'][$inventoryDetail->getId()] = $inventoryDetail;
        }

        return $allRows;
    }

    /**
     * @param SaveInventory $saveInventory
     * @return InventoryDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createInventory(SaveInventory $saveInventory)
    {
        $allData = $this->handleRequest('inventory', Connector::POST, $saveInventory->toArray());
        return new InventoryDetail($allData);
    }

    /**
     * @param $id
     * @param SaveInventory $saveInventory
     * @return InventoryDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateInventory($id, SaveInventory $saveInventory)
    {
        $allData = $this->handleRequest('inventory/' . $id, Connector::PUT, $saveInventory->toArray());
        return new InventoryDetail($allData);
    }

    /**
     * @param $id
     * @return InventoryDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getInventoryDetail($id)
    {
        $allData = $this->handleRequest('inventory/' . $id, Connector::GET);
        return new InventoryDetail($allData);
    }

    /**
     * Seznam skladů.
     *
     * @param array $params
     * @param int|null $page
     * @param int|null $pageSize
     * @return StockMovementOverview[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function getStockMovementList($params = [], $page = null, $pageSize = null)
    {
        if (isset($page) && isset($pageSize)) {
            $params['page'] = $page;
            $params['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('stock_movement', Connector::GET, $params);
        $pageCount = $allData[Parser::PAGE_COUNT];
        unset($allData[Parser::PAGE_COUNT]);
        $allRows = array();
        $allRows[Parser::PAGE_COUNT] = $pageCount;
        $allRows['stock_movement'] = [];
        foreach ($allData['stock_movement'] as $data) {
            if (isset($data['href'])) {
                continue;
            }
            $movementOverview = new StockMovementOverview($data);
            $allRows['stock_movement'][$movementOverview->getId()] = $movementOverview;
        }

        return $allRows;
    }

    /**
     * @param SaveStockMovement $saveStockMovement
     * @return StockMovementDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createStockMovement(SaveStockMovement $saveStockMovement)
    {
        $allData = $this->handleRequest('stock_movement', Connector::POST, $saveStockMovement->toArray());
        return new StockMovementDetail($allData);
    }


    /**
     * @param $id
     * @return StockMovementDetail
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function getStockMovementDetail($id)
    {
        $allData = $this->handleRequest('stock_movement/' . $id, Connector::GET);
        return new StockMovementDetail($allData);
    }


    /**
     * Seznam skladů.
     *
     * @param array $params
     * @param int|null $page
     * @param int|null $pageSize
     * @return ProductOverview[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function getProductList($params = [], $page = null, $pageSize = null)
    {
        if (isset($page) && isset($pageSize)) {
            $params['page'] = $page;
            $params['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('price_list', Connector::GET, $params);
        $pageCount = $allData[Parser::PAGE_COUNT];
        unset($allData[Parser::PAGE_COUNT]);
        $allRows = array();
        $allRows[Parser::PAGE_COUNT] = $pageCount;
        $allRows['price_list'] = [];
        foreach ($allData['price_list'] as $data) {
            if (isset($data['href'])) {
                continue;
            }
            $productDetail = new ProductOverview($data);
            $allRows['price_list'][$productDetail->getId()] = $productDetail;
        }

        return $allRows;
    }

    /**
     * @param SaveProduct $saveProduct
     * @return ProductDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createProduct(SaveProduct $saveProduct)
    {
        $allData = $this->handleRequest('price_list', Connector::POST, $saveProduct->toArray());
        return new ProductDetail($allData);
    }

    /**
     * @param $id
     * @param SaveProduct $saveProduct
     * @return ProductDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateProduct($id, SaveProduct $saveProduct)
    {
        $allData = $this->handleRequest('price_list/' . $id, Connector::PUT, $saveProduct->toArray());
        return new ProductDetail($allData);
    }

    /**
     * @param $id
     * @return ProductDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getProductDetail($id)
    {
        $allData = $this->handleRequest('price_list/' . $id, Connector::GET);
        return new ProductDetail($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteProduct($id)
    {
        $this->handleRequest('price_list/' . $id, Connector::DELETE);
    }


    /**
     * @param $id
     * @param PayDocument $payDocument
     * @return array|mixed|mixed[]|null
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function payProformaInvoiceIssued($id, PayDocument $payDocument)
    {
        $data = $this->handleRequest('proforma_invoice_issued/' . $id . '/pay', Connector::PUT, $payDocument->toArray());
        return new PaymentIssuedDetail($data);
    }

    /**
     * Účetní deník.
     *
     * @param array $params
     * @param int|null $page
     * @param int|null $pageSize
     * @return JournalOverview[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function getJournalList($params = [], $page = null, $pageSize = null)
    {
        if (isset($page) && isset($pageSize)) {
            $params['page'] = $page;
            $params['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('journal', Connector::GET, $params);
        $pageCount = $allData[Parser::PAGE_COUNT];
        unset($allData[Parser::PAGE_COUNT]);
        $allRows = array();
        $allRows[Parser::PAGE_COUNT] = $pageCount;
        $allRows['journal'] = [];
        foreach ($allData['journal'] as $data) {
            if (isset($data['href'])) {
                continue;
            }
            $journalOverview = new JournalOverview($data);
            $allRows['journal'][$journalOverview->getId()] = $journalOverview;
        }

        return $allRows;
    }

    /**
     * @param $id
     * @return JournalDetail
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function getJournalDetail($id)
    {
        $allData = $this->handleRequest('journal/' . $id, Connector::GET);
        return new JournalDetail($allData);
    }
    /**
     *
     * @param array $params
     * @param int|null $page
     * @param int|null $pageSize
     * @return DirectAccountingOverview[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function getDirectAccountingList($params = [], $page = null, $pageSize = null)
    {
        if (isset($page) && isset($pageSize)) {
            $params['page'] = $page;
            $params['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('direct_accounting', Connector::GET, $params);
        $pageCount = $allData[Parser::PAGE_COUNT];
        unset($allData[Parser::PAGE_COUNT]);
        $allRows = array();
        $allRows[Parser::PAGE_COUNT] = $pageCount;
        $allRows['direct_accounting'] = [];
        foreach ($allData['direct_accounting'] as $data) {
            if (isset($data['href'])) {
                continue;
            }
            $directAccountingDetail = new DirectAccountingOverview($data);
            $allRows['direct_accounting'][$directAccountingDetail->getId()] = $directAccountingDetail;
        }

        return $allRows;
    }

    /**
     * @param SaveDirectAccounting $saveDirectAccounting
     * @return DirectAccountingDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createDirectAccounting(SaveDirectAccounting $saveDirectAccounting)
    {
        $allData = $this->handleRequest('direct_accounting', Connector::POST, $saveDirectAccounting->toArray());
        return new DirectAccountingDetail($allData);
    }

    /**
     * @param $id
     * @param SaveDirectAccounting $saveDirectAccounting
     * @return DirectAccountingDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateDirectAccounting($id, SaveDirectAccounting $saveDirectAccounting)
    {
        $allData = $this->handleRequest('direct_accounting/' . $id, Connector::PUT, $saveDirectAccounting->toArray());
        return new DirectAccountingDetail($allData);
    }

    /**
     * @param $id
     * @return DirectAccountingDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getDirectAccountingDetail($id)
    {
        $allData = $this->handleRequest('direct_accounting/' . $id, Connector::GET);
        return new DirectAccountingDetail($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteDirectAccounting($id)
    {
        $this->handleRequest('direct_accounting/' . $id, Connector::DELETE);
    }

    /**
     * Seznam dobropisů přijatých
     * @return CreditNoteReceivedOverview[]
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getCreditNoteReceivedList($params = [], $page = null, $pageSize = null)
    {
        if (isset($page) && isset($pageSize)) {
            $params['page'] = $page;
            $params['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('creditnote_received', Connector::GET, $params);
        $pageCount = $allData[Parser::PAGE_COUNT];
        unset($allData[Parser::PAGE_COUNT]);
        $allRows = array();
        $allRows[Parser::PAGE_COUNT] = $pageCount;
        $allRows['creditnote_received'] = [];
        foreach ($allData['creditnote_received'] as $data) {
            if (isset($data['href'])) {
                continue;
            }
            $creditNoteReceived = new CreditNoteReceivedOverview($data);
            $allRows['creditnote_received'][$creditNoteReceived->getId()] = $creditNoteReceived;
        }

        return $allRows;
    }

    /**
     * @param SaveCreditNoteReceived $saveCreditNoteReceived
     * @return CreditNoteReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createCreditNoteReceived(SaveCreditNoteReceived $saveCreditNoteReceived)
    {
        $allData = $this->handleRequest('creditnote_received', Connector::POST, $saveCreditNoteReceived->toArray());
        return new CreditNoteReceivedDetail($allData);
    }

    /**
     * @param $id
     * @param SaveCreditNoteReceived $saveCreditNoteReceived
     * @return CreditNoteReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateCreditNoteReceived($id, SaveCreditNoteReceived $saveCreditNoteReceived)
    {
        $allData = $this->handleRequest('creditnote_received/' . $id, Connector::PUT, $saveCreditNoteReceived->toArray());
        return new CreditNoteReceivedDetail($allData);
    }

    /**
     * @param $id
     * @return CreditNoteReceivedDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getCreditNoteReceivedDetail($id)
    {
        $allData = $this->handleRequest('creditnote_received/' . $id, Connector::GET);
        return new CreditNoteReceivedDetail($allData);
    }

    /**
     * @param $id
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function deleteCreditNoteReceived($id)
    {
        $this->handleRequest('creditnote_received/' . $id, Connector::DELETE);
    }



    /**
     *
     * @param array $params
     * @param int|null $page
     * @param int|null $pageSize
     * @return BusinessPremisesOverview[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function getBusinessPremisesList($params = [], $page = null, $pageSize = null)
    {
        if (isset($page) && isset($pageSize)) {
            $params['page'] = $page;
            $params['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('business_premises', Connector::GET, $params);
        $pageCount = $allData[Parser::PAGE_COUNT];
        unset($allData[Parser::PAGE_COUNT]);
        $allRows = array();
        $allRows[Parser::PAGE_COUNT] = $pageCount;
        $allRows['business_premises'] = [];
        foreach ($allData['business_premises'] as $data) {
            if (isset($data['href'])) {
                continue;
            }
            $businessPremisesOverview = new BusinessPremisesOverview($data);
            $allRows['business_premises'][$businessPremisesOverview->getId()] = $businessPremisesOverview;
        }

        return $allRows;
    }


    /**
     * @param $id
     * @return BusinessPremisesDetail
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function getBusinessPremisesDetail($id)
    {
        $allData = $this->handleRequest('business_premises/' . $id, Connector::GET);
        return new BusinessPremisesDetail($allData);
    }

    /**
     *
     * @param array $params
     * @param int|null $page
     * @param int|null $pageSize
     * @return EetStatusOverview[] - 2-úrovňové pole.
     *      První úroveň tvoří klíč typ dokladu a pod indexem \IUcto\Parser::PAGE_COUNT je počet dostupných stránek
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function getEetStatusList($params = [], $page = null, $pageSize = null)
    {
        if (isset($page) && isset($pageSize)) {
            $params['page'] = $page;
            $params['pageSize'] = $pageSize;
        }
        $allData = $this->handleRequest('eet_status', Connector::GET, $params);
        $pageCount = $allData[Parser::PAGE_COUNT];
        unset($allData[Parser::PAGE_COUNT]);
        $allRows = array();
        $allRows[Parser::PAGE_COUNT] = $pageCount;
        $allRows['eet_status'] = [];
        foreach ($allData['eet_status'] as $data) {
            if (isset($data['href'])) {
                continue;
            }
            $eetStatusOverview = new EetStatusOverview($data);
            $allRows['eet_status'][$eetStatusOverview->getId()] = $eetStatusOverview;
        }

        return $allRows;
    }

    /**
     * @param SaveEetStatus $saveEetStatus
     * @return EetStatusDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createEetStatus(SaveEetStatus $saveEetStatus)
    {
        $allData = $this->handleRequest('eet_status', Connector::POST, $saveEetStatus->toArray());
        return new EetStatusDetail($allData);
    }


    /**
     * @param $id
     * @return EetStatusDetail
     * @throws BadRequestException
     * @throws ConnectionException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws ServerException
     * @throws UnautorizedException
     * @throws ValidationException
     */
    public function getEetStatusDetail($id)
    {
        $allData = $this->handleRequest('eet_status/' . $id, Connector::GET);
        return new EetStatusDetail($allData);
    }
}
