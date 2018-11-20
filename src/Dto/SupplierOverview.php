<?php

namespace IUcto\Dto;

/**
 * DTO for SupplierOverview data
 *
 * @author iucto.cz
 */
class SupplierOverview
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
     * @var bool
     */
    private $vatPayer;

    /**
     * Email
     *
     * @var string
     */
    private $email;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = $arrayData['id'];
        $this->name = $arrayData['name'];
        $this->comid = $arrayData['comid'];
        $this->vatid = $arrayData['vatid'];
        $this->vatPayer = $arrayData['vat_payer'];
        $this->email = $arrayData['email'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
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

}
