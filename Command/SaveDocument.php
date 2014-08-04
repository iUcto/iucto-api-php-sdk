<?php

/**
 * Comman object pro uložení dokumentu
 *
 * @author admin
 */
class SaveDocument {

    /**
     * Variabilní symbol
     *   
     * @var string (42)
     */
    private $variableSymbol;

    /**
     * Datum vystavení
     *   
     * @var \DateTime
     */
    private $date;

    /**
     * Datum zdanitelného plnění
     *   
     * @var \DateTime
     */
    private $dateVat;

    /**
     * Datum splatnosti
     *   
     * @var \DateTime
     */
    private $maturityDate;

    /**
     * Měna dokladu
     *   
     * @var string (3)
     */
    private $currency;

    /**
     * Celková částka bez DPH
     *   
     * @var int(11)
     */
    private $price;

    /**
     * Celková částka v CZK bez DPH
     *   
     * @var int(11)
     */
    private $priceCzk;

    /**
     * Celková částka s DPH
     *   
     * @var int(11)
     */
    private $priceIncVat;

    /**
     * Celková částka v CZK s DPH
     *   
     * @var int(11)
     */
    private $priceIncVatCzk;

    /**
     * Zbývající částka k úhradě (v měně dokladu)
     *   
     * @var int
     */
    private $toBePaid;

    /**
     * Zákazník
     *   
     * @var CustomerOverview
     */
    private $customerId;

    /**
     * Bankovní účet zákazníka
     *   
     * @var string (45)
     */
    private $customerBankAccount;

    /**
     * Forma úhrady
     *   
     * @var int(1)
     */
    private $paymentType;

    /**
     * Bankovního účet pro příjem platby
     *   
     * @var BankAccount
     */
    private $bankAccount;

    /**
     * Datum zdanitelného plnění
     *   
     * @var \DateTime
     */
    private $dateVatPrev;

    /**
     * Poznámka
     *   
     * @var string
     */
    private $description;

    /**
     * Způsob zaokrouhlení
     *   
     * @var string
     */
    private $roundingType;

    /**
     * Položky dokladu
     *   
     * @var DocumentItem[]
     */
    private $items = array();

    public function __construct(array $dataArray = array()) {
        $this->variableSymbol = ArrayUtils::getValueOrNull($dataArray, 'variable_symbol');
        $this->date = ArrayUtils::getValueOrNull($dataArray, 'date');
        $this->dateVat = ArrayUtils::getValueOrNull($dataArray, 'date_vat');
        $this->maturityDate = ArrayUtils::getValueOrNull($dataArray, 'maturity_date');
        $this->currency = ArrayUtils::getValueOrNull($dataArray, 'currency');
        $this->price = ArrayUtils::getValueOrNull($dataArray, 'price');
        $this->priceCzk = ArrayUtils::getValueOrNull($dataArray, 'price_czk');
        $this->priceIncVat = ArrayUtils::getValueOrNull($dataArray, 'price_inc_vat');
        $this->priceIncVatCzk = ArrayUtils::getValueOrNull($dataArray, 'price_inc_vat_czk');
        $this->toBePaid = ArrayUtils::getValueOrNull($dataArray, 'to_be_paid');
        $this->customerId = ArrayUtils::getValueOrNull($dataArray, 'customer_id');
        $this->customerBankAccount = ArrayUtils::getValueOrNull($dataArray, 'customer_bank_account');
        $this->paymentType = ArrayUtils::getValueOrNull($dataArray, 'payment_type');
        $this->bankAccount = ArrayUtils::getValueOrNull($dataArray, 'bank_account');
        $this->dateVatPrev = ArrayUtils::getValueOrNull($dataArray, 'date_vat_prev');
        $this->description = ArrayUtils::getValueOrNull($dataArray, 'description');
        $this->roundingType = ArrayUtils::getValueOrNull($dataArray, 'rounding_type');
        if (array_key_exists('items', $dataArray)) {
            foreach ($dataArray['items'] as $itemData) {
                $this->items[] = new DocumentItem($itemData);
            }
        }
    }

    public function getVariableSymbol() {
        return $this->variableSymbol;
    }

    public function getDate() {
        return $this->date;
    }

    public function getDateVat() {
        return $this->dateVat;
    }

    public function getMaturityDate() {
        return $this->maturityDate;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getPriceCzk() {
        return $this->priceCzk;
    }

    public function getPriceIncVat() {
        return $this->priceIncVat;
    }

    public function getPriceIncVatCzk() {
        return $this->priceIncVatCzk;
    }

    public function getToBePaid() {
        return $this->toBePaid;
    }

    public function getCustomerId() {
        return $this->customerId;
    }

    public function getCustomerBankAccount() {
        return $this->customerBankAccount;
    }

    public function getPaymentType() {
        return $this->paymentType;
    }

    public function getBankAccount() {
        return $this->bankAccount;
    }

    public function getDateVatPrev() {
        return $this->dateVatPrev;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getRoundingType() {
        return $this->roundingType;
    }

    public function getItems() {
        return $this->items;
    }

    public function setVariableSymbol($variableSymbol) {
        $this->variableSymbol = $variableSymbol;
    }

    public function setDate(\DateTime $date) {
        $this->date = $date;
    }

    public function setDateVat(\DateTime $dateVat) {
        $this->dateVat = $dateVat;
    }

    public function setMaturityDate(\DateTime $maturityDate) {
        $this->maturityDate = $maturityDate;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setPriceCzk($priceCzk) {
        $this->priceCzk = $priceCzk;
    }

    public function setPriceIncVat($priceIncVat) {
        $this->priceIncVat = $priceIncVat;
    }

    public function setPriceIncVatCzk($priceIncVatCzk) {
        $this->priceIncVatCzk = $priceIncVatCzk;
    }

    public function setToBePaid($toBePaid) {
        $this->toBePaid = $toBePaid;
    }

    public function setCustomerId(CustomerOverview $customer) {
        $this->customerId = $customer;
    }

    public function setCustomerBankAccount($customerBankAccount) {
        $this->customerBankAccount = $customerBankAccount;
    }

    public function setPaymentType($paymentType) {
        $this->paymentType = $paymentType;
    }

    public function setBankAccount(BankAccount $bankAccount) {
        $this->bankAccount = $bankAccount;
    }

    public function setDateVatPrev(\DateTime $dateVatPrev) {
        $this->dateVatPrev = $dateVatPrev;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setRoundingType($roundingType) {
        $this->roundingType = $roundingType;
    }

    public function setItems(DocumentItem $items) {
        $this->items = $items;
    }

    public function toArray() {
        $array = array('variable_symbol' => $this->variableSymbol,
            'date' => $this->date,
            'date_vat' => $this->dateVat,
            'maturity_date' => $this->maturityDate,
            'currency' => $this->currency,
            'price' => $this->price,
            'price_czk' => $this->priceCzk,
            'price_inc_vat' => $this->priceIncVat,
            'price_inc_vat_czk' => $this->priceIncVatCzk,
            'to_be_paid' => $this->toBePaid,
            'customer_id' => $this->customerId,
            'customer_bank_account' => $this->customerBankAccount,
            'payment_type' => $this->paymentType,
            'bank_account' => $this->bankAccount,
            'date_vat_prev' => $this->dateVatPrev,
            'description' => $this->description,
            'rounding_type' => $this->roundingType
        );
        $array['items'] = array();
        foreach ($this->items as $item) {
            $array['items'][] = $item->toArray();
        }
        return $array;
    }

}
