<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use DateTime;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property int $space_id
 * @property int $user_id
 * @property string $name
 * @property string $token
 * @property bool $is_default
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property DateTime $softDeletes
 *
 * @property Space $space
 * @property User $user
 */
class Profile extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'profile';

    protected $fillable = ['space_id', 'user_id', 'name', 'token', 'is_default'];

    /**
     * @return BelongsTo<Space, self>
     */
    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }

    /**
     * @return BelongsTo<User, self>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
