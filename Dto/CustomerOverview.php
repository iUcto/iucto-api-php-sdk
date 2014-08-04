<?php

/**
 * Description of CustomerOverview
 *
 * @author admin
 */
class CustomerOverview {

    /**
     * Id zákazníka
     *
     * @var int 
     */
    private $id;

    /**
     * Jméno zákazníka
     *
     * @var string 
     */
    private $name;

    /**
     * IČ
     *
     * @var string 
     */
    private $ico;

    /**
     * DIČ
     *
     * @var string 
     */
    private $dic;

    /**
     * Plátce DPH (ano/ne)
     *
     * @var bool 
     */
    private $vatPayer;

    /**
     * Email
     *
     * @var string 
     */
    private $email;

    public function __construct(array $arrayData) {
        $this->id = $arrayData['id'];
        $this->name = $arrayData['name'];
        $this->ico = $arrayData['ico'];
        $this->dic = $arrayData['dic'];
        $this->vatPayer = $arrayData['vat_payer'];
        $this->email = $arrayData['email'];
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getIco() {
        return $this->ico;
    }

    public function getDic() {
        return $this->dic;
    }

    public function getVatPayer() {
        return $this->vatPayer;
    }

    public function getEmail() {
        return $this->email;
    }

}
