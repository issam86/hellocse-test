<?php

namespace Infrastructure\Models;

use Domain\Profile\Enums\ProfileStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'admin_id',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'status' => ProfileStatus::class,
        ];
    }

    /**
     * @return BelongsTo<Admin, $this>
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * @return HasMany <Comment, $this>
     */
    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class);
    }
}
