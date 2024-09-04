<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id ID
 * @property string $name Nome
 * @property string $email E-mail
 * @property DateTime $email_verified_at E-mail verificado
 * @property string $password Senha
 * @property string $remember_token Token (lembrar-me)
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Collection<int, Profile> $profiles
 */
class User extends Authenticable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'user';

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    /**
     * @return HasMany<Profile>
     */
    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}
