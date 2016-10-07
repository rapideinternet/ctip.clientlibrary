<?php namespace Iza\Datacentralisatie\Traits;

/**
 * Class DefaultAttribute
 * @package Iza\Datacentralisatie\Traits
 */
trait DefaultAttribute
{
    protected $defaultAttribute = false;

    /**
     * @param $defaultAttribute
     * @return $this
     */
    public function setDefault($defaultAttribute)
    {
        $this->defaultAttribute = $defaultAttribute;

        return $this;
    }
}