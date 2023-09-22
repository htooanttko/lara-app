<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gp_id',
        'fir_user_id',
        'fir_status',
        'sec_user_id',
        'sec_status',
        'a_user_id',
        'a_status',
        'b_user_id',
        'b_status',
        'c_user_id',
        'c_status',
        'd_user_id',
        'd_status',
        'e_user_id',
        'e_status',
        'f_user_id',
        'f_status',
        'g_user_id',
        'g_status',
        'h_user_id',
        'h_status',
        'chat_code'
    ];
}
