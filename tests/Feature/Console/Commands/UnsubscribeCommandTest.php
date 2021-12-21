<?php

declare(strict_types=1);

use App\Contracts\Actions\Subscriptions\DeletesSubscription;

it('can unsubscribe a subscriber', function () {
    $this->expectToUseAction(DeletesSubscription::class)
        ->andReturnTrue();

    $this->artisan('site:unsubscribe', ['email' => 'luke@pestphp.com'])
        ->expectsOutput('Successfully unsubscribed luke@pestphp.com')
        ->assertSuccessful();
});

it('falls back to asking for the email', function () {
    $this->expectToUseAction(DeletesSubscription::class)
        ->andReturnTrue();

    $this->artisan('site:unsubscribe')
        ->expectsQuestion('Email to unsubscribe', 'luke@pestphp.com')
        ->assertSuccessful();
});

it('fails if the email is not a subscriber', function () {
    $this->expectToUseAction(DeletesSubscription::class)
        ->andReturnFalse();

    $this->artisan('site:unsubscribe', ['email' => 'luke@pestphp.com'])
        ->expectsOutput('There is no subscriber for the email [luke@pestphp.com]')
        ->assertFailed();
});
