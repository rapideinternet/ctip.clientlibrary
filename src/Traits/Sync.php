<?php namespace Iza\Datacentralisatie\Traits;

trait Sync
{
    protected $sync = false;

    public function setSync($sync)
    {
        $this->sync = $sync;

        return $this;
    }
}