<?php

namespace Invibe\CommonHelpers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class CommonFieldsAndColumns
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers\Facades
 */
class CommonColumns extends Facade
{


    /**
     * @return string
     * @author Adam Ondrejkovic
     */
    protected static function getFacadeAccessor()
    {
        return 'commonColumns';
    }
}
