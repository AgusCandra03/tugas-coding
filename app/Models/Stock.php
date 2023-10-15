<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['id_product', 'qty'];

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'id_product');
    }
}
