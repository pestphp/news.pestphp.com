<?php

declare(strict_types=1);

use App\Contracts\Actions\Subscriptions\CreatesSubscription;
use Spatie\Mailcoach\Domain\Audience\Models\Subscriber;

it('can subscribe a user to the Pest Newsletter', function () {
    $data = [
        'email' => 'luke@pestphp.com',
        'first_name' => 'Luke',
        'last_name' => 'Downing',
    ];

    $this->expectToUseAction(CreatesSubscription::class)
        ->andReturn(Subscriber::factory()->make($data));

    $this->artisan('pest:subscribe', $data)->assertSuccessful();
});

it('can optionally pass in the email', function () {
    $this->expectToUseAction(CreatesSubscription::class)
        ->andReturn(Subscriber::factory()->make(['email' => 'luke@pestphp.com']));

    $this->artisan('pest:subscribe')
        ->expectsQuestion('Email address', 'luke@pestphp.com')
        ->expectsQuestion('First name', 'Luke')
        ->expectsQuestion('Last name', 'Downing')
        ->expectsOutput('Successfully subscribed luke@pestphp.com')
        ->assertSuccessful();
});
