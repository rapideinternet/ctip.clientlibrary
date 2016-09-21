<?php namespace Iza\Datacentralisatie\Traits;

/**
 * Class Sort
 * @package Iza\Datacentralisatie\Traits
 */
trait Sort
{
    protected $sort = [];

    /**
     * @param $sort
     * @return $this
     */
    public function setSort(array $sort = [])
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return string
     */
    public function getSort()
    {
        return implode(',', $this->sort);
    }
}