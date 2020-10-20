<?php

namespace Invibe\CommonHelpers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class TinyMceConfig
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers\Facades
 */
class TinyMceConfig extends Facade
{
    /**
     * @return string
     * @author Adam Ondrejkovic
     */
    protected static function getFacadeAccessor()
    {
        return 'tinyMceConfig';
    }
}
