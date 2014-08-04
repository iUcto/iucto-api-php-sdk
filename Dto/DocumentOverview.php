<?php

/**
 * Description of DocumentOverview
 *
 * @author admin
 */
class DocumentOverview {

    /**
     * ID dokladu
     *   
     * @var int(11)
     */
    private $id;

    /**
     * Číslo dokladu
     *   
     * @var string (45)
     */
    private $sequenceCode;

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
     * Celková částka v CZK s DPH
     *   
     * @var int(11)
     */
    private $priceIncVat;

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
    private $customer;

    /**
     * Doklad je zaúčtován
     *   
     * @var bool
     */
    private $accounted;

    /**
     * Doklad je smazaný
     *   
     * @var bool
     */
    private $deleted;

    /**
     * 
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData) {
        $this->id = ArrayUtils::getValueOrNull($arrayData, 'id');
        $this->sequenceCode = ArrayUtils::getValueOrNull($arrayData, 'sequence_code');
        $this->variableSymbol = ArrayUtils::getValueOrNull($arrayData, 'variable_symbol');
        $this->date = ArrayUtils::getValueOrNull($arrayData, 'date');
        $this->dateVat = ArrayUtils::getValueOrNull($arrayData, 'date_vat');
        $this->maturityDate = ArrayUtils::getValueOrNull($arrayData, 'maturity_date');
        $this->currency = ArrayUtils::getValueOrNull($arrayData, 'currency');
        $this->priceIncVat = ArrayUtils::getValueOrNull($arrayData, 'price_inc_vat');
        $this->toBePaid = ArrayUtils::getValueOrNull($arrayData, 'to_be_paid');
        $this->customer = ArrayUtils::getValueOrNull($arrayData, 'customer');
        $this->accounted = ArrayUtils::getValueOrNull($arrayData, 'accounted');
        $this->deleted = ArrayUtils::getValueOrNull($arrayData, 'deleted');
    }
    
    public function getId() {
        return $this->id;
    }

    public function getSequenceCode() {
        return $this->sequenceCode;
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

    public function getPriceIncVat() {
        return $this->priceIncVat;
    }

    public function getToBePaid() {
        return $this->toBePaid;
    }

    public function getCustomer() {
        return $this->customer;
    }

    public function getAccounted() {
        return $this->accounted;
    }

    public function getDeleted() {
        return $this->deleted;
    }

}
