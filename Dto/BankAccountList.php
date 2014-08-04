<?php

/**
 * Description of BankAccountList
 *
 * @author admin
 */
class BankAccountList {

    /**
     *
     * @var BankAccount
     */
    private $defaultBankAccount;

    /**
     *
     * @var BankAccount[] 
     */
    private $bankAccounts = array();

    public function __construct(array $arrayData) {
        foreach ($arrayData as $data) {
            $bankAccount = new BankAccount($data);
            $this->bankAccounts[] = $bankAccount;
            if ($data['isdefault']) {
                $this->defaultBankAccount = $bankAccount;
            }
        }
    }

    public function getDefaultBankAccount() {
        return $this->defaultBankAccount;
    }

    public function getBankAccounts() {
        return $this->bankAccounts;
    }

}
