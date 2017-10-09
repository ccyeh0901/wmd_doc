<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class VerifiedGroup extends Group
{
    //

	public static function boot()
	{
		parent::boot();
		static::addGlobalScope('verifiedGroup', function (Builder $builder) {
			$builder->where('verified', true);
		});
	}



}
