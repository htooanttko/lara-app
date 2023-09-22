<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockChat extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','blocked_id'];
}
