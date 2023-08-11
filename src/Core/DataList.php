<?php

namespace IUcto\Core;

/**
 * @template TKey
 * @template TValue
 * @implements \IteratorAggregate<TKey, TValue>
 */
abstract class DataList implements \IteratorAggregate
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

    /**
     * @return \ArrayIterator<TKey, TValue>
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->getRecords());
    }

}
