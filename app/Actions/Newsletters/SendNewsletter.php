<?php

declare(strict_types=1);

namespace App\Actions\Newsletters;

use App\Contracts\Actions\Newsletters\SendsNewsletter;
use Spatie\Mailcoach\Domain\Campaign\Models\Campaign;

final class SendNewsletter implements SendsNewsletter
{
    public function handle(Campaign $campaign): void
    {
        $campaign->send();
    }
}
