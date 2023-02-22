<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Majors extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'status',
        'majors_code',
        'created_by',
        'deleted_by'
    ];


    public function user_created ()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function user_deleted ()
    {
        return $this->hasOne(User::class, 'id', 'deleted_by');
    }
}
