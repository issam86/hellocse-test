<?php

namespace Infrastructure\Models;

use Domain\Profile\Enums\ProfileStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * - Attributes.
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property ProfileStatus $status
 * @property int $admin_id
 * @property string $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 **/
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
