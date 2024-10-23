<?php

namespace IUcto\Dto;

/**
 * DTO for Warhehouse data
 *
 * @author iucto.cz
 */
class WarehouseDetail extends RawData
{

    /** @var int */
    private $id;

    /**
     * (povinné)
     *
     * @var string
     */
    private $name;

    /**
     * (povinné)
     *
     * @var bool
     */
    private $is_default;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);
        if (empty($arrayData)) return;

        $this->id = $arrayData['id'];
        $this->name = $arrayData['name'];
        $this->is_default = $arrayData['is_default'];
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
        return $this->is_default;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_default' => $this->is_default,
        ];
    }

}
