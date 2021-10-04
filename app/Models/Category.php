<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table="category";
    protected $primarykey="id";
    protected $fillable = [
        'id',
    ];
    public function getSubcategories()
    {
        return $this->hasMany('App\SubCategory','category_id','id');
    }
    public function getProducts()
    {
        return $this->hasMany('App\Models\Product','cat_id','id');
    }
}
