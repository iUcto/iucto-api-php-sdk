<?php

namespace IUcto\Dto;

/**
 * DTO for Warhehouse data
 *
 * @author iucto.cz
 */
class WarehouseDetail
{

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
        if (empty($arrayData)) return;

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


    public function toArray()
    {
        return [
            'name' => $this->name,
            'is_default' => $this->is_default,
        ];
    }

}
