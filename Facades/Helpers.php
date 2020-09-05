<?php

namespace Invibe\CommonHelpers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Helpers
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers\Facades
 */
class Helpers extends Facade
{
    /**
     * @return string
     * @author Adam Ondrejkovic
     */
    protected static function getFacadeAccessor()
    {
        return 'helpers';
    }
}