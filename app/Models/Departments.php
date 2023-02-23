<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Departments extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'code',
        'name',
        'address',
        'phone_number',
        'email',
        'created_by',
        'deleted_by',
        'status'
    ];

    public function user ()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function user_delete ()
    {
        return $this->hasOne(User::class, 'id', 'deleted_by');
    }
}
