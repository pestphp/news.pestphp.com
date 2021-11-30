<?php

declare(strict_types=1);

namespace App\Actions\Subscriptions;

use App\Contracts\Actions\Subscriptions\CreatesSubscription;
use Illuminate\Support\Facades\Validator;
use Spatie\Mailcoach\Domain\Audience\Models\EmailList;
use Spatie\Mailcoach\Domain\Audience\Models\Subscriber;
use Spatie\Mailcoach\Domain\Audience\Rules\EmailListSubscriptionRule;

final class CreateSubscription implements CreatesSubscription
{
    public function __construct(private EmailList $emailList)
    {
    }

    public function handle(array $data): Subscriber
    {
        Validator::validate($data, [
            'email' => ['required', 'email', new EmailListSubscriptionRule($this->emailList)],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
        ]);

        return $this->emailList->subscribe($data['email'], $data);
    }
}
