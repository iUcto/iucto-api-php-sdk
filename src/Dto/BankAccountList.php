<?php

namespace IUcto\Dto;

/**
 * DTO for BankAccountList data
 *
 * @author iucto.cz
 */
class BankAccountList extends RawData
{

    /**
     *
     * @var BankAccountOverview
     */
    private $defaultBankAccount;

    /**
     *
     * @var BankAccountOverview[]
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

    /**
     * @return BankAccountOverview
     */
    public function getDefaultBankAccount()
    {
        return $this->defaultBankAccount;
    }

    /**
     * @return BankAccountOverview[]
     */
    public function getBankAccounts()
    {
        return $this->bankAccounts;
    }

}
