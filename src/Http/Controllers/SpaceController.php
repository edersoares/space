<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Http\Controllers;

class SpaceController
{
    public function __invoke(): string
    {
        return 'Space for new ideas';
    }
}
