<?php

namespace IUcto\Core;


class Paginator
{
    protected $page = 0;
    protected $pageCount = 0;
    protected $pageSize = 0;


    /**
     * @param $page
     * @param $pageCount
     * @param $pageSize
     */
    public function __construct($page, $pageCount, $pageSize)
    {
        $this->page = $page;
        $this->pageCount = $pageCount;
        $this->pageSize = $pageSize;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }


    public function hasNextPage()
    {
        return $this->page < $this->pageCount;
    }

}
