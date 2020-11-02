<?php

namespace Invibe\CommonHelpers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class CommonFilters
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers\Facades
 */
class CommonFilters extends Facade
{


    /**
     * @return string
     * @author Adam Ondrejkovic
     */
    protected static function getFacadeAccessor()
    {
        return 'commonFilters';
    }
}
