<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Database\Seeders;

use Dex\Laravel\Space\Models\Attribute;
use Dex\Laravel\Space\Models\Entity;
use Dex\Laravel\Space\Models\User;
use Illuminate\Database\Seeder;

class EntityUserSeeder extends Seeder
{
    public function run(): void
    {
        $entity = Entity::query()->updateOrCreate([
            'slug' => 'user',
        ], [
            'label' => 'Usuário',
            'table_name' => 'user',
            'class' => User::class,
        ]);

        Attribute::query()->updateOrCreate([
            'entity_id' => $entity->getKey(),
            'slug' => 'id',
        ], [
            'label' => 'ID',
            'column_name' => 'id',
            'is_filterable' => false,
            'is_searchable' => false,
            'is_sortable' => false,
            'is_includable' => false,
            'is_relation' => false,
            'rules' => [],
        ]);

        Attribute::query()->updateOrCreate([
            'entity_id' => $entity->getKey(),
            'slug' => 'name',
        ], [
            'label' => 'Nome',
            'column_name' => 'name',
            'is_filterable' => true,
            'is_searchable' => true,
            'is_sortable' => true,
            'is_includable' => false,
            'is_relation' => false,
            'rules' => ['required', 'min:3', 'max:100'],
        ]);

        Attribute::query()->updateOrCreate([
            'entity_id' => $entity->getKey(),
            'slug' => 'email',
        ], [
            'label' => 'E-mail',
            'column_name' => 'email',
            'is_filterable' => false,
            'is_searchable' => false,
            'is_sortable' => false,
            'is_includable' => false,
            'is_relation' => false,
            'rules' => [],
        ]);

        Attribute::query()->updateOrCreate([
            'entity_id' => $entity->getKey(),
            'slug' => 'email_verified_at',
        ], [
            'label' => 'E-mail verificado',
            'column_name' => 'email_verified_at',
            'is_filterable' => false,
            'is_searchable' => false,
            'is_sortable' => false,
            'is_includable' => false,
            'is_relation' => false,
            'rules' => [],
        ]);

        Attribute::query()->updateOrCreate([
            'entity_id' => $entity->getKey(),
            'slug' => 'password',
        ], [
            'label' => 'Senha',
            'column_name' => 'password',
            'is_filterable' => true,
            'is_searchable' => false,
            'is_sortable' => false,
            'is_includable' => false,
            'is_relation' => false,
            'rules' => [],
        ]);

        Attribute::query()->updateOrCreate([
            'entity_id' => $entity->getKey(),
            'slug' => 'remember_token',
        ], [
            'label' => 'Token (lembrar-me)',
            'column_name' => 'remember_token',
            'is_filterable' => false,
            'is_searchable' => false,
            'is_sortable' => false,
            'is_includable' => false,
            'is_relation' => false,
            'rules' => [],
        ]);
    }
}
