<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productsModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey="product_id";
    protected $fillable = [
        'name',
        'price'
    ];

    function getGroup(){
        return $this->hasMany('App\Models\imageModel','product_id');
    }
}
