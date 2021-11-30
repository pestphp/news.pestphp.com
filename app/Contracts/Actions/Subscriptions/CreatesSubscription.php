<?php

declare(strict_types=1);

namespace App\Contracts\Actions\Subscriptions;

use Illuminate\Validation\ValidationException;
use Spatie\Mailcoach\Domain\Audience\Models\Subscriber;

interface CreatesSubscription
{
    /**
     * @param array<string, mixed> $data
     *
     * @throws ValidationException
     */
    public function handle(array $data): Subscriber;
}
