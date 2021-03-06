<?php

namespace Invibe\CommonHelpers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class BasicJson
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers\Facades
 */
class BasicJson extends Facade
{
    /**
     * @return string
     * @author Adam Ondrejkovic
     */
    protected static function getFacadeAccessor()
    {
        return 'basicJson';
    }
}
