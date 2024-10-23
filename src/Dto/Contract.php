<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for Contract data
 *
 * @author iucto.cz
 */
class Contract extends RawData
{

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $code;

    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @var string
     */
    private $description;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->code = Utils::getValueOrNull($arrayData, 'code');
        $this->name = Utils::getValueOrNull($arrayData, 'name');
        $this->description = Utils::getValueOrNull($arrayData, 'description');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

}
