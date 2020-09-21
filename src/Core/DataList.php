<?php

namespace IUcto\Core;

abstract class DataList
{
    /** @var Paginator */
    protected $paginator;

    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @return Paginator
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /** @return array */
    abstract public function getRecords();

    /** @return string[] */
    public function getIds()
    {
        return array_map(function ($value) {
            return (string)$value;
        }, array_keys($this->getRecords()));
    }

}
