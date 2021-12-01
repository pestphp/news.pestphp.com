<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

final class SetupCommand extends Command
{
    protected $signature = 'pest:setup';

    protected $description = 'Setup the project on a new machine';

    public function handle(): int
    {
        $this->callSilent('migrate:fresh');
        $this->callSilent('wink:migrate');
        $this->callSilent('db:seed');

        $this->line('Setup complete!');

        return Command::SUCCESS;
    }
}
