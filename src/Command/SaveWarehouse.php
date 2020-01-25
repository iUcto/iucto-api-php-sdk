<?php

namespace IUcto\Command;

/**
 * Description of SaveWarehouse
 *
 * @author iucto.cz
 */
class SaveWarehouse
{

    /**
     * Název
     *
     * @var string
     */
    private $name;

    /**
     * Příznak zda jde o výchozí sklad
     * @var bool
     */
    private $isDefault;

    function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) {
            return;
        }

        $this->name = $arrayData['name'];
        $this->isDefault = $arrayData['is_default'];
    }


    public function toArray()
    {
        return [
            'name' => $this->name,
            'is_default' => $this->isDefault,
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    }


}
