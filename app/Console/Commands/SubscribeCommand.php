<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Contracts\Actions\Subscriptions\CreatesSubscription;
use Illuminate\Console\Command;

final class SubscribeCommand extends Command
{
    protected $signature = 'site:subscribe {email?} {first_name?} {last_name?}';

    protected $description = 'Subscribe a user to the Pest Newsletter';

    public function handle(CreatesSubscription $createsSubscription): int
    {
        $subscriber = $createsSubscription->handle([
            'email' => $this->argument('email') ?? $this->ask('Email address'),
            'first_name' => $this->argument('first_name') ?? $this->ask('First name'),
            'last_name' => $this->argument('last_name') ?? $this->ask('Last name'),
        ]);

        $this->line("Successfully subscribed {$subscriber->email}");

        return Command::SUCCESS;
    }
}
