<?php

namespace IUcto\Dto;

/**
 * DTO for CustomerOverview data
 *
 * @author iucto.cz
 */
class CustomerOverview
{

    /**
     * Id zákazníka
     *
     * @var int
     */
    protected $id;

    /**
     * Jméno zákazníka
     *
     * @var string
     */
    protected $name;

    /**
     * IČ
     *
     * @var string
     */
    protected $comid;

    /**
     * DIČ
     *
     * @var string
     */
    protected $vatid;

    /**
     * Plátce DPH (ano/ne)
     *
     * @var bool
     */
    protected $vatPayer;

    /**
     * Email
     *
     * @var string
     */
    protected $email;

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
