<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
    protected $table="sub_categories";
    protected $primarykey="id";
    protected $fillable = [
        'id',
    ];

    public function SubcategoryCategory()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
}
