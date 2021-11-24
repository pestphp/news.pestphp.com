<?php

declare(strict_types=1);

namespace App\Contracts\Actions\Subscriptions;

use Illuminate\Validation\ValidationException;

interface CreatesSubscription
{
    /**
     * @throws ValidationException
     */
    public function handle(array $data): void;
}
