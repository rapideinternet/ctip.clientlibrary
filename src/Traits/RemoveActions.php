<?php namespace Iza\Datacentralisatie\Traits;

/**
 * Class RemoveActions
 * @package Iza\Datacentralisatie\Traits
 */
trait RemoveActions
{
    protected $removeActions = false;

    /**
     * @param $removeActions
     * @return $this
     */
    public function setRemoveActions($removeActions)
    {
        $this->removeActions = $removeActions;

        return $this;
    }
}