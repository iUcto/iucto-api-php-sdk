<?php

namespace IUcto\Dto;

/**
 * DTO for Company profile data
 *
 * @author iucto.cz
 */
class CompanyProfile extends RawData
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $nameDisplay = null;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var string|null
     */
    private $phone = null;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string|null
     */
    private $www = null;

    /**
     * ID Datové schránky
     * @var string|null
     */
    private $dataBoxId = null;

    /**
     * Jednatel společnosti
     * @var CompanyOwner
     */
    private $owner;

    /**
     * @var string|null
     */
    private $ico = null;

    /**
     * @var string|null
     */
    private $vat = null;

    /**
     * @var string|null
     */
    private $icp = null;

    /**
     * Typ plátce DPH
     * @see \IUcto\IUcto::getVATs()
     * @var string
     */
    private $vatType;

    /**
     * Typ subjektu
     * @var string|null
     */
    private $subjectType = null;

    /**
     * Typ účtování
     * @var string
     */
    private $accountingType;

    /**
     * @var bool
     */
    private $ossStatus = false;

    public function __construct(array $arrayData)
    {
        parent::__construct($arrayData);
        if (empty($arrayData)) {
            return;
        }

        $this->name = $arrayData['name'];
        $this->nameDisplay = $arrayData['name_display'];
        $this->address = new Address($arrayData['address']);
        $this->phone = $arrayData['phone'];
        $this->email = $arrayData['email'];
        $this->www = $arrayData['www'];
        $this->dataBoxId = $arrayData['data_box_id'];
        $this->owner = new CompanyOwner($arrayData['owner']);
        $this->ico = $arrayData['ico'];
        $this->vat = $arrayData['vat'];
        $this->icp = $arrayData['icp'];

        $this->vatType = $arrayData['vat_type'];
        $this->subjectType = $arrayData['subject_type'];
        $this->accountingType = $arrayData['accounting_type'];
        $this->ossStatus = $arrayData['oss_status'];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNameDisplay(): ?string
    {
        return $this->nameDisplay;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getWww(): ?string
    {
        return $this->www;
    }

    public function getDataBoxId(): ?string
    {
        return $this->dataBoxId;
    }

    public function getOwner(): CompanyOwner
    {
        return $this->owner;
    }

    public function getIco(): ?string
    {
        return $this->ico;
    }

    public function getVat(): ?string
    {
        return $this->vat;
    }

    public function getIcp(): ?string
    {
        return $this->icp;
    }

    public function getVatType(): string
    {
        return $this->vatType;
    }

    public function getSubjectType(): ?string
    {
        return $this->subjectType;
    }

    public function getAccountingType(): string
    {
        return $this->accountingType;
    }

    public function getOssStatus(): bool
    {
        return $this->ossStatus;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setNameDisplay(string $nameDisplay): void
    {
        $this->nameDisplay = $nameDisplay;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setWww(?string $www): void
    {
        $this->www = $www;
    }

    public function setDataBoxId(?string $dataBoxId): void
    {
        $this->dataBoxId = $dataBoxId;
    }

    public function setOwner(CompanyOwner $owner): void
    {
        $this->owner = $owner;
    }

    public function setIco(?string $ico): void
    {
        $this->ico = $ico;
    }

    public function setVat(?string $vat): void
    {
        $this->vat = $vat;
    }

    public function setIcp(?string $icp): void
    {
        $this->icp = $icp;
    }

    public function setVatType(string $vatType): void
    {
        $this->vatType = $vatType;
    }

    public function setSubjectType(?string $subjectType): void
    {
        $this->subjectType = $subjectType;
    }

    public function setAccountingType(string $accountingType): void
    {
        $this->accountingType = $accountingType;
    }

    public function setOssStatus(bool $ossStatus): bool
    {
        $this->ossStatus = $ossStatus;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'name_display' => $this->nameDisplay,
            'address' => $this->address->toArray(),
            'phone' => $this->phone,
            'email' => $this->email,
            'www' => $this->www,
            'data_box_id' => $this->dataBoxId,
            'owner' => $this->owner->toArray(),
            'ico' => $this->ico,
            'vat' => $this->vat,
            'icp' => $this->icp,
            'vat_type' => $this->vatType,
            'subject_type' => $this->subjectType,
            'accounting_type' => $this->accountingType,
            'oss_status' => $this->ossStatus,
        ];
    }
}
