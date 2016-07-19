<?php namespace Iza\Datacentralisatie\Traits;

/**
 * Class Depth
 * @package Iza\Datacentralisatie\Traits
 */
trait Depth
{
    protected $depth = false;

    /**
     * @param $depth
     * @return $this
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }
}