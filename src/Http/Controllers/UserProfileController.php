<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Http\Controllers;

use Dex\Laravel\Space\Extensions\Orion\FluentQuery;
use Dex\Laravel\Space\Extensions\Orion\Whitelist;
use Dex\Laravel\Space\Models\User;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;
use Orion\Http\Requests\Request;

class UserProfileController extends RelationController
{
    use DisableAuthorization;
    use FluentQuery;
    use Whitelist;

    protected $model = User::class;

    protected $relation = 'profiles';

    public function index(Request $request, $parentKey)
    {
        $this->setFilterQuery($request);
        $this->setSearchQuery($request);
        $this->setShowQuery($request);
        $this->setSortQuery($request);

        return parent::index($request, $parentKey);
    }

    public function alwaysIncludes(): array
    {
        return [
            'space',
        ];
    }

    public function sortableBy(): array
    {
        return [
            'name',
        ];
    }
}
