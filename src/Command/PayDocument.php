<?php

namespace IUcto\Command;

use IUcto;
use IUcto\Utils;

/**
 * @author iucto.cz
 */
class PayDocument
{
    protected $bank_account;
    protected $cash_register;
    protected $date;

    public function __construct($data)
    {
        $this->date = $data;
    }

    public function toArray()
    {
        return [
          'date' => $this->date,
          'bank_account' => $this->bank_account,
          'cash_register' => $this->cash_register,
        ];
    }

    /**
     * @return mixed
     */
    public function getBankAccount()
    {
        return $this->bank_account;
    }

    /**
     * @param mixed $bank_account
     */
    public function setBankAccount($bank_account)
    {
        $this->bank_account = $bank_account;
    }

    /**
     * @return mixed
     */
    public function getCashRegister()
    {
        return $this->cash_register;
    }

    /**
     * @param mixed $cash_register
     */
    public function setCashRegister($cash_register)
    {
        $this->cash_register = $cash_register;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }



}
