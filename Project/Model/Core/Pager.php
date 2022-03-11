<?php
class Model_Core_Pager
{
    protected $perPageCount = 20;
    protected $totalCount = 0;
    protected $pageCount = 20;
    protected $start = 1;
    protected $end = 20;
    protected $prev = 20;
    protected $next = 20;
    protected $current = 20;
    protected $startLimit = 20;
    protected $endLimit = 20;

    public function getPerPageCount()
    {
        return $this->perPageCount;
    }

    public function setPerPageCount($perPageCount)
    {
        $this->perPageCount = $perPageCount;
    }

    public function getTotalCount()
    {
        return $this->totalCount;
    }

    public function setTotalCount($totalCount)
    {
        $this->totalCount = $totalCount;
    }

    public function getPageCount()
    {
        return $this->pageCount;
    }

    public function setPageCount($pageCount)
    {
        $this->pageCount = $pageCount;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function setEnd($end)
    {
        $this->end = $end;
    }

    public function getPrev()
    {
        return $this->prev;
    }

    public function setPrev($prev)
    {
        $this->prev = $prev;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function setNext($next)
    {
        $this->next = $next;
    }

    public function getCurrent()
    {
        return $this->current;
    }

    public function setCurrent($current)
    {
        $this->current = $current;
    }

    public function getStartLimit()
    {
        return $this->startLimit;
    }

    public function setStartLimit($startLimit)
    {
        $this->startLimit = $startLimit;
    }

    public function getEndLimit()
    {
        return $this->endLimit;
    }

    public function setEndLimit($endLimit)
    {
        $this->endLimit = $endLimit;
    }
    
    public function execute($totalCount, $current)
    {
        $this->setTotalCount($totalCount);
        $this->setPageCount(ceil($this->getTotalCount() / $this->getPerPageCount()));
        $this->setCurrent(($current > $this->getPageCount()) ? $this->getPageCount() : $current);
        $this->setCurrent(($current < $this->getStart()) ? $this->getStart() : $this->getCurrent());

        $this->setStart(($this->getCurrent() == 1) ? null : 1);
        $this->setEnd(($this->getCurrent() == $this->getPageCount()) ? null : $this->getPageCount());

        $this->setStartLimit($this->getPerPageCount() * ($this->getCurrent() - 1));

        $this->setPrev(($this->getCurrent() == 1) ? null : $this->getCurrent());

        $this->setNext(($this->getCurrent() == $this->getPageCount()) ? null : $this->getCurrent() + 1);
    }

    function getAdapter()
    {
        global $adapter;
        return $adapter;
    }
}