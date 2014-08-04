<?php

require_once __DIR__ . '/Connector.php';
require_once __DIR__ . '/Parser.php';
require_once __DIR__ . '/ErrorHandler.php';

require_once __DIR__ . '/Dto/DocumentOverview.php';
require_once __DIR__ . '/Dto/DocumentItem.php';
require_once __DIR__ . '/Dto/DocumentDetail.php';
require_once __DIR__ . '/Dto/Department.php';
require_once __DIR__ . '/Dto/CustomerOverview.php';
require_once __DIR__ . '/Dto/Customer.php';
require_once __DIR__ . '/Dto/ContractOverview.php';
require_once __DIR__ . '/Dto/Contract.php';
require_once __DIR__ . '/Dto/BankAccount.php';
require_once __DIR__ . '/Dto/BankAccountList.php';
require_once __DIR__ . '/Dto/Address.php';

require_once __DIR__ . '/Command/SaveCustomer.php';
require_once __DIR__ . '/Command/SaveDocument.php';

require_once __DIR__ . '/ArrayUtils.php';

/**
 * @author IUcto
 */
class IUcto {

    private $connector;
    private $parser;
    private $errorHandler;

    public function __construct(Connector $connector, Parser $parser, ErrorHandler $errorHandler) {
        $this->connector = $connector;
        $this->parser = $parser;
        $this->errorHandler = $errorHandler;
    }

    private function handleRequest($address, $method, array $data = array()) {        
        $response = $this->connector->request($address, $method, $data);
        $data = $this->parser->parse($response);
        if (isset($data['errors']) && is_array($data['errors'])) {
            $this->errorHandler->handleErrors($data['errors']);
        }
        return $data;
    }

    /**
     * Zjednodušený výpis všech dostupných dokladů.
     * 
     * @return DocumentOverview[][] - 2-úrovňové pole. První úroveň tvoří klíč typ dokladu. 
     */
    public function getAllDocuments() {
        $allData = $this->handleRequest('invoice_issued', Connector::GET);
        $allDocuments = array();
        foreach ($allData as $type => $typeData) {
            foreach ($typeData as $data) {
                $allDocuments[$type][] = new DocumentOverview($data);
            }            
        }
        return $allDocuments;
    }

    /**
     * Vytvoří nový doklad, odpověd obsahuje detail dokladu.
     * 
     * @param SaveDocument $saveDocument
     * @return DocumentDetail
     */
    public function createNewDocument(SaveDocument $saveDocument) {
        $allData = $this->handleRequest('invoice_issued', Connector::POST, $saveDocument->toArray());
        return new DocumentDetail($allData);
    }

    /**
     * Vrátí kompletní kolekci dat vybraného dokladu.
     * 
     * @param int $id
     * @return mixed []
     */
    public function getDocumentDetail($id) {
        $allData = $this->handleRequest('invoice_issued/' . $id, Connector::GET);
        return new DocumentDetail($allData);
    }

    /**
     * Aktulizuje předané parametry vybraného dokladu. Poviné ple jsou stejná jako při vkládání nového záznamu.
     * 
     * @param int $id
     * @param mixed [] $data
     * @return mixed []
     */
    public function updateDocument($id, array $data) {
        $allData = $this->handleRequest('invoice_issued/' . $id, Connector::PUT, $data);
        return new DocumentDetail($allData);
    }

    /**
     * Pokusí se smazat vybraný dokladu. Pokud je doklad vázán na jiný záznam, vrátí chybu a doklad se nasmaže.
     * 
     * @param int $id
     * @return void
     */
    public function deleteDocument($id) {
        $this->handleRequest('invoice_issued/' . $id, Connector::DELETE);
    }

    /**
     * Zjednodušený výpis všech dostupných zákazníků.
     * 
     * @return mixed []
     */
    public function getCustomers() {
        $allData = $this->handleRequest('customer', Connector::GET);
        return new CustomerOverview($allData);
    }

    /**
     * Vytvoří nový doklad, odpověd obsahuje detail vytvořeného zákazníka.
     * 
     * @param mixed [] $data
     * @return mixed []
     */
    public function createCustomer(SaveCustomer $saveCustomer) {
        $allData = $this->handleRequest('customer', Connector::POST, $saveCustomer->toArray());
        return new Customer($allData);
    }

    /**
     * Vrátí veškerá data k zákazníkovi.
     * 
     * @param int $id
     * @return mixed []
     */
    public function getCustomerDetail($id) {
        $allData = $this->handleRequest('customer/' . $id, Connector::GET);
        return new Customer($allData);
    }

    /**
     * Aktulizuje předané parametry vybraného zákazníka. Poviné ple jsou stejná jako při vkládání nového zákazníka.
     * 
     * @param int $id
     * @param mixed [] $data
     * @return mixed []
     */
    public function updateCustomer($id, SaveCustomer $saveCustomer) {
        $allData = $this->handleRequest('customer/' . $id, Connector::PUT, $saveCustomer);
        return new Customer($allData);
    }

    /**
     * Pokusí se smazat vybraného zákazníka. Pokud je ovšem vázán na jiný záznam (faktury, platba, apod.), vrátí chybu a zákazník se nasmaže.
     * 
     * @param int $id
     * @return type
     */
    public function deleteCustomer($id) {
        $allData = $this->handleRequest('customer/' . $id, Connector::DELETE);
    }

    /**
     * Seznam dostupných bankovních účtů.
     * 
     * @return mixed []
     */
    public function getAllAccounts() {
        $allData = $this->handleRequest('bank_account', Connector::GET);
        return new BankAccountList($allData);
    }

    /**
     * Seznam dostupných měn pro použití v dokladech.Dostupnost se může měnit v závislosti na aktivaci rozšíření Účtování v cizích měnách.
     * 
     * @return mixed []
     */
    public function getCurrencies() {
        return $this->handleRequest('currency', Connector::GET);
    }

    /**
     * Seznam metod pro zaokrouhlování částek v dokladech.
     * 
     * @return mixed []
     */
    public function getRoundingTypes() {
        return $this->handleRequest('rounding_type', Connector::GET);
    }

    /**
     * Seznam dostupných metod pro provedení platby používaných v dokladech.
     * 
     * @return mixed []
     */
    public function getMethods() {
        return $this->handleRequest('payment_type', Connector::GET);
    }

    /**
     * Seznam kurzů DPH k danému datu.
     * 
     * @param int $date unix timestamp
     * @return mixed []
     */
    public function getVATRatesOn($date) {
        return $this->handleRequest('vat_rates?date=' . $date, Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných účetních položek v závislosti na parametru doctype. Formát odpovědi: {"id": "popis"}
     * 
     * @param string $doctype
     * @return mixed []
     */
    public function getAccountingEntryTypes($doctype = "FV") {
        return $this->handleRequest('accountentry_type?doctype=' . $doctype, Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných typů DPH v závislosti na parametru doctype. Formát odpovědi: {"id": "popis"}
     * 
     * @param string $doctype
     * @return mixed []
     */
    public function getVATs($doctype = "FV") {
        return $this->handleRequest('accountentry_type?doctype=' . $doctype, Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných účtů úč. osnovy pro použití v dokladech.{"id": "popis"}
     * 
     * @return mixed []
     */
    public function getAccounts() {
        return $this->handleRequest('chart_account', Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných Účty DPH pro použití v dokladech.{"id": "popis"}
     * 
     * @return type
     */
    public function getAccountVATs() {
        return $this->handleRequest('vat_chart', Connector::GET);
    }

    /**
     * Výpis dostupných středisek.
     *  
     * @return mixed []
     */
    public function getDepartments() {
        $allData = $this->handleRequest('department', Connector::GET);
        $departments = array();
        foreach ($allData as $data) {
            $departments[] = new Department($data);
        }
        return $departments;
    }

    /**
     * Výpis dostupných zakázek.
     * 
     * @return type
     */
    public function getContracts() {
        $allData = $this->handleRequest('contract', Connector::GET);
        $contracts = array();
        foreach ($allData as $data) {
            $contracts[] = new Contract($data);
        }
        return $contracts;
    }

    /**
     * Seznam dostupných metod.
     * 
     * @return mixed []
     */
    public function getPaymentMethods() {
        return $this->handleRequest('preferred_payment_method', Connector::GET);
    }

    /**
     * Seznam dostupných států.
     * 
     * @return mixed []
     */
    public function getStates() {
        return $this->handleRequest('country', Connector::GET);
    }

}
