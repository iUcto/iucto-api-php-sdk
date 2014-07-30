<?php

require_once __DIR__ . '/Connector.php';
require_once __DIR__ . '/Parser.php';
require_once __DIR__ . '/ErrorHandler.php';

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
     * @return mixed[]
     */
    public function getAllAvailableDocuments() {
        return $this->handleRequest('invoice_issued', Connector::GET);
    }

    /**
     * Vytvoří nový doklad, odpověd obsahuje detail dokladu.
     * 
     * @param mixed[] $data
     * @return mixed []
     */
    public function createNewDocument(array $data) {
        return $this->handleRequest('invoice_issued', Connector::POST, $data);
    }

    /**
     * Vrátí kompletní kolekci dat vybraného dokladu.
     * 
     * @param int $id
     * @return mixed []
     */
    public function getDocumentDetail($id) {
        return $this->handleRequest('invoice_issued/' + $id, Connector::GET);
    }

    /**
     * Aktulizuje předané parametry vybraného dokladu. Poviné ple jsou stejná jako při vkládání nového záznamu.
     * 
     * @param int $id
     * @param mixed [] $data
     * @return mixed []
     */
    public function updateDocument($id, array $data) {
        return $this->handleRequest('invoice_issued/' + $id, Connector::PUT, $data);
    }

    /**
     * Pokusí se smazat vybraný dokladu. Pokud je doklad vázán na jiný záznam, vrátí chybu a doklad se nasmaže.
     * 
     * @param int $id
     * @return type
     */
    public function deleteDocument($id) {
        return $this->handleRequest('invoice_issued/' + $id, Connector::DELETE);
    }

    /**
     * Zjednodušený výpis všech dostupných zákazníků.
     * 
     * @return mixed []
     */
    public function getListOfCustomers() {
        return $this->handleRequest('customer', Connector::GET);
    }

    /**
     * Vytvoří nový doklad, odpověd obsahuje detail vytvořeného zákazníka.
     * 
     * @param mixed [] $data
     * @return mixed []
     */
    public function createCustomer(array $data) {
        return $this->handleRequest('customer', Connector::POST, $data);
    }

    /**
     * Vrátí veškerá data k zákazníkovi.
     * 
     * @param int $id
     * @return mixed []
     */
    public function getCustomerDetail($id) {
        return $this->handleRequest('customer/' + $id, Connector::GET);
    }

    /**
     * Aktulizuje předané parametry vybraného zákazníka. Poviné ple jsou stejná jako při vkládání nového zákazníka.
     * 
     * @param int $id
     * @param mixed [] $data
     * @return mixed []
     */
    public function updateCustomer($id, array $data) {
        return $this->handleRequest('customer/' + $id, Connector::PUT, $data);
    }

    /**
     * Pokusí se smazat vybraného zákazníka. Pokud je ovšem vázán na jiný záznam (faktury, platba, apod.), vrátí chybu a zákazník se nasmaže.
     * 
     * @param int $id
     * @return type
     */
    public function deleteCustomer($id) {
        return $this->handleRequest('customer/' + $id, Connector::DELETE);
    }

    /**
     * Seznam dostupných bankovních účtů.
     * 
     * @return mixed []
     */
    public function getAllAvailableAccounts() {
        return $this->handleRequest('bank_account', Connector::GET);
    }

    /**
     * Seznam dostupných měn pro použití v dokladech.Dostupnost se může měnit v závislosti na aktivaci rozšíření Účtování v cizích měnách
     * 
     * @return mixed []
     */
    public function getListOfAvailableCurrencies() {
        return $this->handleRequest('currency', Connector::GET);
    }

    /**
     * Seznam metod pro zaokrouhlování částek v dokladech.
     * 
     * @return mixed []
     */
    public function getListOfAvailableRoundingTypes() {
        return $this->handleRequest('rounding_type', Connector::GET);
    }

    /**
     * Seznam dostupných metod pro provedení platby používaných v dokladech.
     * 
     * @return mixed []
     */
    public function getListOfAvailableMethods() {
        return $this->handleRequest('payment_type', Connector::GET);
    }

    /**
     * Seznam kurzů DPH k danému datu.
     * 
     * @param int $date unix timestamp
     * @return mixed []
     */
    public function getListOfVATRatesOnThatDate($date) {
        return $this->handleRequest('vat_rates?date=' + $date, Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných účetních položek v závislosti na parametru doctype. Formát odpovědi: {"id": "popis"}
     * 
     * @param string $doctype
     * @return mixed []
     */
    public function getListOfAccountingEntryTypes($doctype = "FV") {
        return $this->handleRequest('accountentry_type?doctype=' + $doctype, Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných typů DPH v závislosti na parametru doctype. Formát odpovědi: {"id": "popis"}
     * 
     * @param string $doctype
     * @return mixed []
     */
    public function getListOfVATs($doctype = "FV") {
        return $this->handleRequest('accountentry_type?doctype=' + $doctype, Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných účtů úč. osnovy pro použití v dokladech.{"id": "popis"}
     * 
     * @return mixed []
     */
    public function getListOfAvailableAccounts() {
        return $this->handleRequest('chart_account', Connector::GET);
    }

    /**
     * Odpověd obsahuje pole dostupných Účty DPH pro použití v dokladech.{"id": "popis"}
     * 
     * @return type
     */
    public function getListOfAvailableAccountVATs() {
        return $this->handleRequest('vat_chart', Connector::GET);
    }

    /**
     * Výpis dostupných středisek.
     *  
     * @return mixed []
     */
    public function getAvailableResponsibilityCenters() {
        return $this->handleRequest('department', Connector::GET);
    }

    /**
     * Výpis dostupných zakázek.
     * 
     * @return type
     */
    public function getAvailableContracts() {
        return $this->handleRequest('contract', Connector::GET);
    }

    /**
     * Seznam dostupných metod.
     * 
     * @return mixed []
     */
    public function getListOfAvailableMethodsOfPayment() {
        return $this->handleRequest('preferred_payment_method', Connector::GET);
    }

    /**
     * Seznam dostupných států.
     * 
     * @return mixed []
     */
    public function getListOfAvailableStates() {
        return $this->handleRequest('country', Connector::GET);
    }

}
