<?php

declare(strict_types=1);

use App\Actions\Subscriptions\CreateSubscription;
use Illuminate\Support\Str;
use Spatie\Mailcoach\Domain\Audience\Models\EmailList;
use Spatie\Mailcoach\Domain\Audience\Models\Subscriber;

it('subscribes the given user to the Pest Newsletter', function () {
    $action = $this->app->make(CreateSubscription::class);

    $subscriber = $action->handle([
        'email' => 'luke@pestphp.com',
        'first_name' => 'Luke',
        'last_name' => 'Downing',
    ]);

    expect(Subscriber::count())->toBe(1);

    expect($subscriber)
        ->exists->toBeTrue()
        ->email->toBe('luke@pestphp.com')
        ->first_name->toBe('Luke')
        ->last_name->toBe('Downing')
        ->emailList->is(EmailList::firstWhere('name', 'Pest Newsletter'))->toBeTrue();
});

it('validates the given data', function (array $data, array $expectedErrors) {
    $action = $this->app->make(CreateSubscription::class);

    expect(fn () => $action->handle($data))->toHaveErrors($expectedErrors);
})->with([
    [[], ['email' => 'required', 'first_name' => 'required', 'last_name' => 'required']],
    [['email' => 'foobar'], ['email' => 'email']],
    [['first_name' => 123], ['first_name' => 'string']],
    [['first_name' => Str::repeat('a', 256)], ['first_name' => '255']],
    [['last_name' => 123], ['last_name' => 'string']],
    [['last_name' => Str::repeat('a', 256)], ['last_name' => '255']],
]);

it('does not allow the same email to be subscribed twice', function () {
    Subscriber::create([
        'email' => 'luke@pestphp.com',
        'email_list_id' => EmailList::firstWhere('name', 'Pest Newsletter')->getKey(),
        'subscribed_at' => now(),
    ]);

    $action = $this->app->make(CreateSubscription::class);
    expect(fn () => $action->handle(['email' => 'luke@pestphp.com']))->toHaveErrors([
        'email' => 'already subscribed',
    ]);
});
