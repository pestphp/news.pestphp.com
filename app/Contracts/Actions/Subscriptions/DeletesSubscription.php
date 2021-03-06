<?php

declare(strict_types=1);

namespace App\Contracts\Actions\Subscriptions;

use Illuminate\Validation\ValidationException;

interface DeletesSubscription
{
    /**
     * @throws ValidationException
     */
    public function handle(string $email): bool;
}
