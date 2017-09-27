<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

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
	protected $casts = [
		'address' => 'array',
		'arriving_date'  => 'datetime',
		'leaving_date'   => 'datetime',
		'wmd_visit_from' => 'datetime',
		'wmd_visit_end'  => 'datetime',
		'schedule' => 'array'

	];

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

	public function article() //屬於哪篇文章
	{
		return $this->belongsTo('Backpack\NewsCRUD\app\Models\Article', 'article_id');
	}

	public function articles() //跨文章
	{
		return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Article', 'group_article');
	}

	public function category() //屬於哪個分類
	{
		return $this->belongsTo('Backpack\NewsCRUD\app\Models\Category', 'category_id');
	}

	public function categories() //跨分類
	{
		return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Category', 'group_category');
	}

	public function tags()  //跨標籤
	{
		return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Tag', 'group_tag');
	}


	public function groups() //載入某一個團的副團s
	{
		return $this->hasMany(__CLASS__, 'parent_id');
	}

	public function allGroups() //某個團底下的所有的副團
	{
		return $this->groups()->with(__FUNCTION__);
	}

	public function creator() //誰開的團
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function members()
	{
		return $this->hasMany(\app\Models\Member, 'group_id');

	}

	public function parent()
	{
		return $this->belongsTo('App\Models\Group', 'parent_id')->where('parent_id', null);

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
