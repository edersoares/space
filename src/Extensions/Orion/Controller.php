<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Extensions\Orion;

use Orion\Http\Controllers\Controller as OrionController;
use Orion\Http\Requests\Request;

class Controller extends OrionController
{
    use Cast;
    use FluentQuery;
    use Whitelist;

    public function index(Request $request)
    {
        $this->setFilterQuery($request);
        $this->setSearchQuery($request);
        $this->setShowQuery($request);
        $this->setSortQuery($request);

        return parent::index($request);
    }
}
