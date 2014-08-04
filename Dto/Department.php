<?php

/**
 * Description of DepartmentOverview
 *
 * @author admin
 */
class Department {

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

    public function __construct(array $dataArray) {
        $this->id = ArrayUtils::getValueOrNull($dataArray, 'id');
        $this->code = ArrayUtils::getValueOrNull($dataArray, 'code');
        $this->name = ArrayUtils::getValueOrNull($dataArray, 'name');
        $this->description = ArrayUtils::getValueOrNull($dataArray, 'description');
    }

    public function getId() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

}
