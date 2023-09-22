<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'group_name',
        'group_image',
        'fir_user_id',
        'sec_user_id',
        'a_user_id',
        'b_user_id',
        'c_user_id',
        'd_user_id',
        'e_user_id',
        'f_user_id',
        'g_user_id',
        'h_user_id'
    ];
}
