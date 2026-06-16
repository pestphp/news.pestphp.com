<?php

declare(strict_types=1);

namespace App\Actions\Newsletters;

use App\Contracts\Actions\Newsletters\SendsTestNewsletter;
use Spatie\Mailcoach\Domain\Campaign\Models\Campaign;
use Wink\WinkAuthor;

final class SendTestNewsletter implements SendsTestNewsletter
{
    public function handle(Campaign $campaign): void
    {
        $campaign->sendTestMail(WinkAuthor::query()->pluck('email')->all());
    }
}
