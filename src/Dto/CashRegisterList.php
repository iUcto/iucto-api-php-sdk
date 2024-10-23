<?php

namespace IUcto\Dto;

/**
 * DTO for CashRegisterlist data
 *
 * @author iucto.cz
 */
class CashRegisterlist extends RawData
{

    /** @var CashRegisterOverview */
    private $defaultCashRegister;

    /** @var CashRegisterOverview[] */
    private $cashRegisters = array();

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData)
    {
        foreach ($arrayData as $data) {
            $cashRegister = new CashRegisterOverview($data);
            $this->cashRegisters[] = $cashRegister;
            if ($data['isdefault']) {
                $this->defaultCashRegister = $cashRegister;
            }
        }
    }

    /**
     * @return CashRegisterOverview
     */
    public function getDefaultCashRegister()
    {
        return $this->defaultCashRegister;
    }

    /**
     * @return CashRegisterOverview[]
     */
    public function getCashRegister()
    {
        return $this->cashRegisters;
    }

}
