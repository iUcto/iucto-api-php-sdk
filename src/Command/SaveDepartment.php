<?php

namespace IUcto\Command;

/**
 * Description of SaveDepartment
 *
 * @author iucto.cz
 */
class SaveDepartment
{
    /**
     * Kód
     *
     * @var string
     */
    private $code;

    /**
     * Název
     *
     * @var string
     */
    private $name;

    /**
     * Popis
     * 
     * @var string
     */
    private $description;
    
    /**
     * Příznak zda je středisko smazané
     * @var bool
     */
    private $deleted;

    function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) {
            return;
        }

        $this->code = $arrayData['code'];
        $this->name = $arrayData['name'];
        $this->description = $arrayData['description'];
        $this->deleted = $arrayData['deleted'];        
    }


    public function toArray()
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'deleted' => $this->deleted,            
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
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
    
    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }
    
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}