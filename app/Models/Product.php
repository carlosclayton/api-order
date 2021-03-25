<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuid;

    public $incrementing = false;
    protected $keyType = "string";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code',
        'name',
        'price',
    ];

    protected $hidden = [
        'user_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
