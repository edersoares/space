<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    use HasFactory;

    protected $table = 'user_social';

    protected $fillable = ['provider', 'provider_id', 'user_id', 'name', 'email', 'nickname', 'avatar'];
}
