<?php

namespace Infrastructure\Models;

use Domain\Admin\Enums\ProfileStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'image'
    ];

    protected function casts(): array
    {
        return [
            'status' => ProfileStatus::class,
        ];
    }

    public function getAdmin():BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function getComments():hasMany
    {
        return $this->hasMany(Comment::class);
    }

}
