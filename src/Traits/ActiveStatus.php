<?php
/**
 * @author Adam Ondrejkovic
 * Created by PhpStorm.
 * Date: 28/06/2020
 * Time: 15:31
 */

namespace Invibe\CommonHelpers\Traits;


use Illuminate\Database\Eloquent\Builder;
use Invibe\CommonHelpers\Scopes\Active;

/**
 * Trait ActiveStatus
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers\Traits
 */
trait ActiveStatus
{
    /**
     * @author Adam Ondrejkovic
     */
	protected static function booted() : void
	{
		static::addGlobalScope(new Active());
	}

    /**
     * @param Builder $builder
     * @return Builder
     * @author Adam Ondrejkovic
     */
	public function scopeWithInactive(Builder $builder) : Builder
	{
		return $builder->withoutGlobalScope(Active::class);
	}

    /**
     * @param Builder $builder
     * @return Builder
     * @author Adam Ondrejkovic
     */
	public function scopeOnlyInactive(Builder $builder) : Builder
	{
		return $builder->withoutGlobalScope(Active::class)->where('active', false);
	}
}