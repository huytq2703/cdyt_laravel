<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Roles extends Model
{
    use HasFactory;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'roles';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'permissions',
        'description',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_code', 'code');
    }
}
