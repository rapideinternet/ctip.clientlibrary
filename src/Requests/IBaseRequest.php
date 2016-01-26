<?php

namespace Iza\Datacentralisatie;

interface IBaseRequest
{
    public function getMethod();

    public function getPath();

    public function getParameters();

    public function getBodySchema();
}