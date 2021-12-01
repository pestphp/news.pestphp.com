<?php

declare(strict_types=1);

use App\Actions\Subscriptions\DeleteSubscription;
use Spatie\Mailcoach\Domain\Audience\Models\EmailList;
use Spatie\Mailcoach\Domain\Audience\Models\Subscriber;

it('can delete an existing subscription', function () {
    Subscriber::factory()->create([
        'email' => 'luke@pestphp.com',
        'email_list_id' => $this->app->make(EmailList::class)->getKey(),
    ]);

    expect(Subscriber::query()->subscribed()->count())->toBe(1);

    $action = $this->app->make(DeleteSubscription::class);
    $result = $action->handle('luke@pestphp.com');

    expect($result)->toBeTrue();
    expect(Subscriber::query()->subscribed()->count())->toBe(0);
});

it('returns false if the email is not subscribed', function () {
    $action = $this->app->make(DeleteSubscription::class);
    $result = $action->handle('luke@pestphp.com');

    expect($result)->toBeFalse();
});

it('must be given a valid email', function () {
    $action = $this->app->make(DeleteSubscription::class);

    expect(fn () => $action->handle('foo'))->toHaveErrors([
        'email' => 'email',
    ]);
});
