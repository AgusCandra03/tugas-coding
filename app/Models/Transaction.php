<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['id_product', 'id_user', 'qty', 'total'];

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'id_product');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}
