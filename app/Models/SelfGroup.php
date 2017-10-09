<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SelfGroup extends Group
{
    //

	public static function boot()
	{
		parent::boot();
		static::addGlobalScope('selfGroup', function (Builder $builder) {
			$builder->where('user_id', auth()->user()->id);
		});
	}



}
