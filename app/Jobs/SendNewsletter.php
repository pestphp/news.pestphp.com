<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Contracts\Actions\Newsletters\SendsNewsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Mailcoach\Domain\Campaign\Models\Campaign;

final class SendNewsletter implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(private Campaign $campaign)
    {
    }

    public function handle(SendsNewsletter $sender): void
    {
        $sender->handle($this->campaign);
    }
}
