<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for ProductDetail data
 *
 * @author iucto.cz
 */
class ProductDetail extends ProductOverview
{

    protected $accountentry_type_id;
    protected $chart_account_id;
    protected $vattype_id;
    protected $vat_chart_id;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        parent::__construct($arrayData);

        if (empty($arrayData)) return;

        $this->accountentry_type_id = Utils::getValueOrNull($arrayData, 'accountentry_type_id');
        $this->chart_account_id = Utils::getValueOrNull($arrayData, 'chart_account_id');
        $this->vattype_id = Utils::getValueOrNull($arrayData, 'vattype_id');
        $this->vat_chart_id = Utils::getValueOrNull($arrayData, 'vat_chart_id');
    }


    /**
     * @return mixed|null
     */
    public function getAccountentryTypeId()
    {
        return $this->accountentry_type_id;
    }

    /**
     * @return mixed|null
     */
    public function getChartAccountId()
    {
        return $this->chart_account_id;
    }

    /**
     * @return mixed|null
     */
    public function getVattypeId()
    {
        return $this->vattype_id;
    }

    /**
     * @return mixed|null
     */
    public function getVatChartId()
    {
        return $this->vat_chart_id;
    }


    public function toArray()
    {
        $array = parent::toArray();
        $array += [
            'accountentry_type_id' => $this->accountentry_type_id,
            'chart_account_id' => $this->chart_account_id,
            'vattype_id' => $this->vattype_id,
            'vat_chart_id' => $this->vat_chart_id,
        ];
        return $array;
    }

}
