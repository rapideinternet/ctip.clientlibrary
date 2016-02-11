<?php namespace Iza\Datacentralisatie\Traits;

trait PerPage
{

    protected $page = 1;
    protected $perPage = 15;

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;

        return $this;
    }

    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }
}