<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QA extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'qas';

    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'q_title',
        'q_content',
        'a_title',
        'a_content',
        'user_answer_id',
        'answered_at',
        'deleted_by',
        'status'
    ];
}
