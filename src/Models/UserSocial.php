<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $provider
 * @property string $provider_id
 * @property string $user_id
 * @property string $name
 * @property string $email
 * @property string $nickname
 * @property string $avatar
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class UserSocial extends Model
{
    use HasFactory;

    protected $table = 'user_social';

    protected $fillable = ['provider', 'provider_id', 'user_id', 'name', 'email', 'nickname', 'avatar'];
}
