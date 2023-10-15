<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','id_category', 'price', 'stock'];

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'id_category');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'id_product');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Stock', 'id_product');
    }
}
