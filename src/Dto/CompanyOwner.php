<?php

namespace IUcto\Dto;

/**
 * DTO for Company Owner data
 *
 * @author iucto.cz
 */
class CompanyOwner extends RawData
{
    /** @var string */
    private $firstName = '';

    /** @var string */
    private $lastName = '';

    public function __construct(array $arrayData)
    {
        parent::__construct($arrayData);
        if (empty($arrayData)) {
            return;
        }

        $this->firstName = $arrayData['first_name'];
        $this->lastName = $arrayData['last_name'];
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
        ];
    }
}
