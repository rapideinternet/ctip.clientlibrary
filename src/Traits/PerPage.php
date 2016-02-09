<?php namespace Iza\Datacentralisatie\Traits;

trait PerPage {
	
    protected $page = 1;
    protected $perPage = 15;

    public function setPerPage($perPage) {
        return $this->perPage = $perPage;
    }
	
    public function setPage($page)  {
        return $this->page = $page;
    }
}