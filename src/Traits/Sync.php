<?php namespace Iza\Datacentralisatie\Traits;

/**
 * Class Sync
 * @package Iza\Datacentralisatie\Traits
 */
trait Sync
{
    protected $sync = false;

    /**
     * @param $sync
     * @return $this
     */
    public function setSync($sync)
    {
        $this->sync = $sync;

        return $this;
    }
}