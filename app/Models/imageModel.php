<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageModel extends Model
{
    use HasFactory;
    protected $table = 'files';
    protected $fillable = [
        'files',
        'product_id'
    ];
}
