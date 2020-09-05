<?php
/**
 * @author Adam Ondrejkovic
 * Created by PhpStorm.
 * Date: 28/06/2020
 * Time: 15:34
 */

namespace Invibe\CommonHelpers\Traits;

/**
 * Trait ClearGlobalScopes
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers\Traits
 */
trait ClearGlobalScopes
{
	/**
	 * @author Adam Ondrejkovic
	 */
	public function clearGlobalScopes()
	{
		static::$globalScopes = [];
	}
}