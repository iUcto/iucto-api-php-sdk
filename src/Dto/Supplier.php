<?php

namespace IUcto\Dto;

/**
 * DTO for Customer data
 *
 * @author iucto.cz
 */
class Supplier
{

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
     * Zobrazované jméno
     *
     * @var string
     */
    private $nameDisplay;

    /**
     * IČ
     *
     * @var string
     */
    private $comid;

    /**
     * DIČ
     *
     * @var string
     */
    private $vatid;

    /**
     * Plátce DPH (ano/ne)
     *
     * @var string
     */
    private $vatPayer;

    /**
     * Email
     *
     * @var string
     */
    private $email;

    /**
     * Telefon
     *
     * @var string
     */
    private $phone;

    /**
     * Mobil
     *
     * @var string
     */
    private $cellphone;

    /**
     * WWW
     *
     * @var string
     */
    private $www;

    /**
     * Adresa
     *
     * @var Address
     */
    private $address;

    /**
     *  Poznámka
     *
     * @var string
     */
    private $note;

    /**
     * Číslo účtu 1
     *
     * @var string
     */
    private $accountNumber1;

    /**
     * Číslo účtu 2
     *
     * @var string
     */
    private $accountNumber2;

    /**
     * Číslo účtu 3
     *
     * @var string
     */
    private $accountNumber3;

    /**
     * Číslo účtu 4
     *
     * @var string
     */
    private $accountNumber4;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = $arrayData['id'];
        $this->name = $arrayData['name'];
        $this->nameDisplay = $arrayData['name_display'];
        $this->comid = $arrayData['comid'];
        $this->vatid = $arrayData['vatid'];
        $this->vatPayer = $arrayData['vat_payer'];
        $this->email = $arrayData['email'];
        $this->phone = $arrayData['phone'];
        $this->cellphone = $arrayData['cellphone'];
        $this->www = $arrayData['www'];
        $this->address = new Address($arrayData['address']);
        $this->note = $arrayData['note'];
        $this->accountNumber1 = $arrayData['account_number1'];
        $this->accountNumber2 = $arrayData['account_number2'];
        $this->accountNumber3 = $arrayData['account_number3'];
        $this->accountNumber4 = $arrayData['account_number4'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNameDisplay()
    {
        return $this->nameDisplay;
    }

    public function getComid()
    {
        return $this->comid;
    }

    public function getVatid()
    {
        return $this->vatid;
    }

    public function getVatPayer()
    {
        return $this->vatPayer;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getCellphone()
    {
        return $this->cellphone;
    }

    public function getWww()
    {
        return $this->www;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getAccountNumber1()
    {
        return $this->accountNumber1;
    }

    public function getAccountNumber2()
    {
        return $this->accountNumber2;
    }

    public function getAccountNumber3()
    {
        return $this->accountNumber3;
    }

    public function getAccountNumber4()
    {
        return $this->accountNumber4;
    }

}
