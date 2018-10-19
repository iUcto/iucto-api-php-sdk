<?php

namespace IUcto\Dto;

/**
 * DTO for BankAccountList data
 *
 * @author iucto.cz
 */
class BankAccountList
{

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

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        foreach ($arrayData as $data) {
            $bankAccount = new BankAccountOverview($data);
            $this->bankAccounts[] = $bankAccount;
            if ($data['isdefault']) {
                $this->defaultBankAccount = $bankAccount;
            }
        }
    }

    public function getDefaultBankAccount()
    {
        return $this->defaultBankAccount;
    }

    public function getBankAccounts()
    {
        return $this->bankAccounts;
    }

}
