<?php

namespace IUcto;

use IUcto\Command\SaveBankAccount;
use IUcto\Command\SaveBankTransaction;
use IUcto\Command\SaveCustomer;
use IUcto\Command\SaveInvoiceIssued;
use IUcto\Command\SaveInvoiceReceived;
use IUcto\Command\SaveOrderIssued;
use IUcto\Command\SaveOrderReceived;
use IUcto\Command\SavePayment;
use IUcto\Command\SaveSupplier;
use IUcto\Dto\BankAccount;
use IUcto\Dto\BankAccountList;
use IUcto\Dto\BankTransactionList;
use IUcto\Dto\BankTransactionOverview;
use IUcto\Dto\CashRegisterList;
use IUcto\Dto\Contract;
use IUcto\Dto\Customer;
use IUcto\Dto\CustomerOverview;
use IUcto\Dto\Department;
use IUcto\Dto\InvoiceIsseudOverview;
use IUcto\Dto\InvoiceIssuedDetail;
use IUcto\Dto\InvoiceReceivedDetail;
use IUcto\Dto\InvoiceReceivedOverview;
use IUcto\Dto\OrderIssuedDetail;
use IUcto\Dto\OrderIssuedOverview;
use IUcto\Dto\OrderReceivedDetail;
use IUcto\Dto\OrderReceivedOverview;
use IUcto\Dto\PaymentDetail;
use IUcto\Dto\PaymentIssuedOverview;
use IUcto\Dto\PaymentReceivedOverview;
use IUcto\Dto\Supplier;
use IUcto\Dto\SupplierOverview;


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
     * @throws ConnectionException
     * @throws ValidationException
     */
    private function handleRequest($address, $method, array $data = array())
    {
        $response = $this->connector->request($address, $method, $data);
        if ($method == Connector::DELETE) {
            return $response;
        }
        $data = $this->parser->parse($response);
        if (isset($data['errors']) && is_array($data['errors'])) {
            $this->errorHandler->handleErrors($data['errors']);
        }
        return $data;
    }

    /**
     * Zjednodušený výpis všech dostupných dokladů.
     *
     * @return InvoiceIsseudOverview[] - 2-úrovňové pole. První úroveň tvoří klíč typ dokladu.
     * @throws ConnectionException
     * @throws ValidationException
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
    public function getCustomers()
    {
        $allData = $this->handleRequest('customer', Connector::GET);

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
     * @return array
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getSuppliers()
    {
        $allData = $this->handleRequest('supplier', Connector::GET);

        $allSuppliers = array();
        if (isset($allData['supplier'])) {
            foreach ($allData['supplier'] as $supplier) {
                $allSuppliers[] = new SupplierOverview($supplier);
            }
        }
        return $allSuppliers;
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
     * @return PaymentDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createReceivedPayment(SavePayment $saveReceivedPayment)
    {
        $allData = $this->handleRequest('payment_received', Connector::POST, $saveReceivedPayment->toArray());
        return new PaymentDetail($allData);
    }

    /**
     * @param $id
     * @param SavePayment $saveReceivedPayment
     * @return PaymentDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateReceivedPayment($id, SavePayment $saveReceivedPayment)
    {
        $allData = $this->handleRequest('payment_received/' . $id, Connector::PUT, $saveReceivedPayment->toArray());
        return new PaymentDetail($allData);
    }

    /**
     * @param $id
     * @return PaymentDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getReceivedPaymentDetail($id)
    {
        $allData = $this->handleRequest('payment_received/' . $id, Connector::GET);
        return new PaymentDetail($allData);
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
     * @return PaymentDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function createIssuedPayment(SavePayment $saveIssuedPayment)
    {
        $allData = $this->handleRequest('payment_issued', Connector::POST, $saveIssuedPayment->toArray());
        return new PaymentDetail($allData);
    }

    /**
     * @param $id
     * @param SavePayment $saveIssuedPayment
     * @return PaymentDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function updateIssuedPayment($id, SavePayment $saveIssuedPayment)
    {
        $allData = $this->handleRequest('payment_issued/' . $id, Connector::PUT, $saveIssuedPayment->toArray());
        return new PaymentDetail($allData);
    }

    /**
     * @param $id
     * @return PaymentDetail
     * @throws ConnectionException
     * @throws ValidationException
     */
    public function getIssuedPaymentDetail($id)
    {
        $allData = $this->handleRequest('payment_issued/' . $id, Connector::GET);
        return new PaymentDetail($allData);
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


}
