<?php

declare(strict_types=1);

namespace App\Contracts\Actions\Newsletters;

use Spatie\Mailcoach\Domain\Campaign\Models\Campaign;

interface SendsNewsletter
{
    public function handle(Campaign $campaign): void;
}
