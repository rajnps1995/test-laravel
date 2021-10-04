<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table="product";
    protected $primarykey="id";
    protected $fillable = [
        'id',
    ];

    public function productcategory()
    {
        return $this->belongsTo('App\Models\Category','cat_id','id');
    }
}
