<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for CashRegisterlist data
 *
 * @author admin
 */
class CashRegisterlist {

    /**
     *
     * @var $defaultCashRegister
     */
    private $defaultCashRegister;

    /**
     *
     * @var $cashRegisters[] 
     */
    private $cashRegisters = array();

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData) {
        foreach ($arrayData as $data) {
            $cashRegister = new cashRegisterOverview($data);
            $this->cashRegisters[] = $cashRegister;
            if ($data['isdefault']) {
                $this->defaultCashRegister = $cashRegister;
            }
        }
    }

    public function getDefaultCashRegister() {
        return $this->defaultCashRegister;
    }

    public function getCashRegister() {
        return $this->cashRegisters;
    }

}
