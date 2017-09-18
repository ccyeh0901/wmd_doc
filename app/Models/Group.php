<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Group extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'groups';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
     protected $fillable = ['name', 'type', 'parent_id', 'category_id','article_id', 'tag_id', 'arriving_date', 'leaving_date', 'wmd_visit_from', 'wmd_visit_end', 'estimated_number', 'leader_name', 'contact_method', 'user_id', 'schedule', 'description', 'verified', 'apply_url', 'apply_url']; //這邊不需要article_id 因為他跟article之間是多對多的關係！

    // protected $hidden = [];
    // protected $dates = [];
//	protected $casts = [
//		'address' => 'array',
//	];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

	public function openGoogle($crud = false)
	{
		return '<a class="btn btn-xs btn-default" target="_blank" href="http://google.com?q='.urlencode($this->text).'" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Google it</a>';
	}

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

	public function article()
	{
		return $this->belongsTo('Backpack\NewsCRUD\app\Models\Article', 'select2_from_ajax');
	}

	public function articles()
	{
		return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Article', 'monster_article');
	}

	public function category()
	{
		return $this->belongsTo('Backpack\NewsCRUD\app\Models\Category', 'select');
	}

	public function categories()
	{
		return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Category', 'monster_category');
	}

	public function tags()
	{
		return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Tag', 'monster_tag');
	}



    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
