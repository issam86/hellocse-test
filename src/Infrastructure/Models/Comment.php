<?php

namespace Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'content',
        'admin_id',
        'profile_id',
    ];


}
