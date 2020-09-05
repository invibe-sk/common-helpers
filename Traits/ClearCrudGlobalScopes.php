<?php
/**
 * @author Adam Ondrejkovic
 * Created by PhpStorm.
 * Date: 28/06/2020
 * Time: 15:36
 */

namespace Invibe\CommonHelpers\Traits;

/**
 * Trait ClearCrudGlobalScopes
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers\Traits
 */
trait ClearCrudGlobalScopes
{
	/**
	 * @author Adam Ondrejkovic
	 */
	public function clearCrudGlobalScopes()
	{
		$this->crud->query = $this->crud->query->withoutGlobalScopes();
		$this->crud->model->clearGlobalScopes();
	}
}