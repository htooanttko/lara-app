<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatLists extends Model
{
    use HasFactory;
    protected $fillable = [
        'fir_user_id',
        'sec_user_id'
    ];
}
