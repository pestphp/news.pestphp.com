<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Contracts\Actions\Newsletters\CreatesNewsletter;
use App\Contracts\Actions\Newsletters\SendsTestNewsletter;
use App\Jobs\SendNewsletter;
use Illuminate\Console\Command;

final class BuildNewsletterCommand extends Command
{
    protected $signature = 'site:newsletter {--force}';

    protected $description = 'Build, test and prepare to send this week\'s newsletter';

    public function handle(CreatesNewsletter $creator, SendsTestNewsletter $tester): int
    {
        if (!$campaign = $creator->handle()) {
            $this->warn('There was no news to send!');

            return Command::SUCCESS;
        }

        $this->info("View the newsletter in your browser: {$campaign->webviewUrl()}");
        $tester->handle($campaign);

        if ($this->option('force') || $this->confirm('Are you sure you want to send this newsletter?')) {
            $delay = now()->addHours(3);
            SendNewsletter::dispatch($campaign)->delay($delay);
            $this->info("The newsletter will be sent to all subscribers in {$delay->diffForHumans()}.");
        }

        return Command::SUCCESS;
    }
}
