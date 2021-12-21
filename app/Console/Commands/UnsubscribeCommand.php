<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Contracts\Actions\Subscriptions\DeletesSubscription;
use Illuminate\Console\Command;

final class UnsubscribeCommand extends Command
{
    protected $signature = 'site:unsubscribe {email?}';

    protected $description = 'Unsubscribes a subscriber from the Pest Newsletter';

    public function handle(DeletesSubscription $deletesSubscription): int
    {
        $email = $this->argument('email') ?? $this->ask('Email to unsubscribe');

        if ($deletesSubscription->handle($email)) {
            $this->line("Successfully unsubscribed {$email}");

            return Command::SUCCESS;
        }

        $this->error("There is no subscriber for the email [{$email}]");

        return Command::FAILURE;
    }
}
