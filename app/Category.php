<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['nameEn','nameAr','parentId'];
    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parentId');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parentId');
    }
}

