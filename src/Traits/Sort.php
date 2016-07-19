<?php namespace Iza\Datacentralisatie\Traits;

/**
 * Class Sort
 * @package Iza\Datacentralisatie\Traits
 */
trait Sort
{
    protected $sort = "";

    /**
     * @param $sort
     * @return $this
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }
}