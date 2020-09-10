<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for EetStatusOverview data
 *
 * @author iucto.cz
 */
class EetStatusOverview
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $uuidZpravy;

    /** @var string */
    protected $pkp;

    /** @var string */
    protected $bkp;

    /** @var string */
    protected $fik;

    /** @var string */
    protected $status;

    /** @var bool */
    protected $external;

    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) return;

        $this->id = Utils::getValueOrNull($arrayData, 'id');
        $this->uuidZpravy = Utils::getValueOrNull($arrayData,'uuid_zpravy');
        $this->pkp = Utils::getValueOrNull($arrayData,'pkp');
        $this->bkp = Utils::getValueOrNull($arrayData,'bkp');
        $this->fik = Utils::getValueOrNull($arrayData,'fik');
        $this->status = Utils::getValueOrNull($arrayData,'status');
        $this->external = Utils::getValueOrNull($arrayData,'external');
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
    public function getUuidZpravy()
    {
        return $this->uuidZpravy;
    }

    /**
     * @return string
     */
    public function getPkp()
    {
        return $this->pkp;
    }

    /**
     * @return string
     */
    public function getBkp()
    {
        return $this->bkp;
    }

    /**
     * @return string
     */
    public function getFik()
    {
        return $this->fik;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isExternal()
    {
        return $this->external;
    }


}
