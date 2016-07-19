<?php namespace Iza\Datacentralisatie\Traits;

/**
 * Class Sync
 * @package Iza\Datacentralisatie\Traits
 */
trait IsNested
{
    protected $isNested = false;

    /**
     * @param $isNested
     * @return $this
     */
    public function setIsNested($isNested)
    {
        $this->isNested = $isNested;

        return $this;
    }
}