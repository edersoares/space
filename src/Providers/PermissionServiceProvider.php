<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Providers;

use Dex\Laravel\Space\Extensions\Permission\Permission;
use Dex\Laravel\Space\Extensions\Permission\Role;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        config([
            'permission.models.permission' => Permission::class,
            'permission.models.role' => Role::class,
            'permission.table_names' => [
                'roles' => 'role',
                'permissions' => 'permission',
                'model_has_permissions' => 'model_permission',
                'model_has_roles' => 'model_role',
                'role_has_permissions' => 'role_permission',
            ],
        ]);
    }
}
