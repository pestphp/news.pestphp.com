<?php

declare(strict_types=1);

namespace App\Actions\Subscriptions;

use App\Contracts\Actions\Subscriptions\DeletesSubscription;
use Illuminate\Support\Facades\Validator;
use Spatie\Mailcoach\Domain\Audience\Models\EmailList;

final class DeleteSubscription implements DeletesSubscription
{
    public function __construct(private EmailList $emailList)
    {
    }

    public function handle(string $email): bool
    {
        Validator::validate(['email' => $email], ['email' => ['email']]);

        return $this->emailList->unsubscribe($email);
    }
}
