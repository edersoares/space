<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Console\Commands;

use Illuminate\Console\Command;

class SpaceCommand extends Command
{
    protected $signature = 'space';

    protected $description = 'Space for new ideas';

    public function handle(): int
    {
        $this->comment('Space for new ideas');

        return self::SUCCESS;
    }
}
