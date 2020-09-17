<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for BusinessPremisesOverview data
 *
 * @author iucto.cz
 */
class BusinessPremisesOverview
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var bool */
    protected $isdefault;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->name = Utils::getValueOrNull($arrayData, 'name');
        $this->isdefault = Utils::getValueOrNull($arrayData, 'isdefault');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->isdefault;
    }


}
