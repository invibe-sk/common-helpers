<?php

namespace Invibe\CommonHelpers\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Class Active
 * @author Adam Ondrejkovic
 * @package App\Scopes
 */
class Active implements Scope
{

    /**
     * @param Builder $builder
     * @param Model $model
     * @return Builder
     * @author Adam Ondrejkovic
     */
	public function apply(Builder $builder, Model $model) : Builder
	{
		return $builder->where('active', true);
	}
}