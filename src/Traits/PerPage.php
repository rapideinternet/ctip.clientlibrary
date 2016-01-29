<?php namespace Iza\Datacentralisatie\Traits;

trait PerPage
{
    protected $perPage = 15;

    public function setPerPage($perPage)
    {
        return $this->perPage = $perPage;
    }
}