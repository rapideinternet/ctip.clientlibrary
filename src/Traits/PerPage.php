<?php namespace Iza\Datacentralisatie\Traits;

/**
 * Class PerPage
 * @package Iza\Datacentralisatie\Traits
 */
trait PerPage
{

    protected $page = 1;
    protected $perPage = 15;

    /**
     * @param $perPage
     * @return $this
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * @param $page
     * @return $this
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }
}