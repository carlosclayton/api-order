<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuid;

    public $incrementing = false;
    protected $keyType = "string";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'phone',
        'user_id'
    ];

    protected $hidden = [
        'user_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
