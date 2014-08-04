<?php

/**
 * Description of DocumentItem
 *
 * @author admin
 */
class DocumentItem {

    /**
     * ID položky
     *   
     * @var int(11)
     */
    private $id;

    /**
     * Počet
     *   
     * @var decimal(12,2)
     */
    private $amount;

    /**
     * Jednotka
     *   
     * @var string(10)
     */
    private $unit;

    /**
     * Cena za jednotku
     *   
     * @var decimal(12,2)
     */
    private $price;

    /**
     * Popis
     *   
     * @var string(255)
     */
    private $text;

    /**
     * DPH
     *   
     * @var decimal(5,2)
     */
    private $vat;

    /**
     * Typ účetní položky
     *   
     * @var int(11)
     */
    private $accountentrytypeId;

    /**
     * Typ DPH
     *   
     * @var int(11)
     */
    private $vattypeId;

    /**
     * Účet účetní osnovy
     *   
     * @var int(11)
     */
    private $chartAccountId;

    /**
     * Účet DPH
     *   
     * @var int(11)
     */
    private $vatChartId;

    /**
     * Středisko
     *   
     * @var int(11)
     */
    private $departmentId;

    /**
     * Zakázka
     *   
     * @var int(11)
     */
    private $contractId;

    public function __construct(array $dataArray) {
        $this->id = ArrayUtils::getValueOrNull($dataArray, 'id');
        $this->amount = ArrayUtils::getValueOrNull($dataArray, 'amount');
        $this->unit = ArrayUtils::getValueOrNull($dataArray, 'unit');
        $this->price = ArrayUtils::getValueOrNull($dataArray, 'price');
        $this->text = ArrayUtils::getValueOrNull($dataArray, 'text');
        $this->vat = ArrayUtils::getValueOrNull($dataArray, 'vat');
        $this->accountentrytypeId = ArrayUtils::getValueOrNull($dataArray, 'accountentrytype_id');
        $this->vattypeId = ArrayUtils::getValueOrNull($dataArray, 'vattype_id');
        $this->chartAccountId = ArrayUtils::getValueOrNull($dataArray, 'chart_account_id');
        $this->vatChartId = ArrayUtils::getValueOrNull($dataArray, 'vat_chart_id');
        $this->departmentId = ArrayUtils::getValueOrNull($dataArray, 'department_id');
        $this->contractId = ArrayUtils::getValueOrNull($dataArray, 'contract_id');
    }

    public function toArray() {
        return array('id' => $this->id,
            'amount' => $this->amount,
            'unit' => $this->unit,
            'price' => $this->price,
            'text' => $this->text,
            'vat' => $this->vat,
            'acountentrtype_id' => $this->accountentrytypeId,
            'vattype_id' => $this->vattypeId,
            'chart_account_id' => $this->chartAccountId,
            'vat_chart_id' => $this->vatChartId,
            'department_id' => $this->departmentId,
            'contract_id' => $this->contractId);
    }

    public function getId() {
        return $this->id;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getUnit() {
        return $this->unit;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getText() {
        return $this->text;
    }

    public function getVat() {
        return $this->vat;
    }

    public function getAccountentrytypeId() {
        return $this->accountentrytypeId;
    }

    public function getVattypeId() {
        return $this->vattypeId;
    }

    public function getChartAccountId() {
        return $this->chartAccountId;
    }

    public function getVatChartId() {
        return $this->vatChartId;
    }

    public function getDepartmentId() {
        return $this->departmentId;
    }

    public function getContractId() {
        return $this->contractId;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function setUnit($unit) {
        $this->unit = $unit;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setVat($vat) {
        $this->vat = $vat;
    }

    public function setAccountentrytypeId($acountentrtypeId) {
        $this->accountentrytypeId = $acountentrtypeId;
    }

    public function setVattypeId($vattype) {
        $this->vattypeId = $vattype;
    }

    public function setChartAccountId($chartAccountId) {
        $this->chartAccountId = $chartAccountId;
    }

    public function setVatChartId($vatChartId) {
        $this->vatChartId = $vatChartId;
    }

    public function setDepartmentId($departmentId) {
        $this->departmentId = $departmentId;
    }

    public function setContractId($contractId) {
        $this->contractId = $contractId;
    }

}
