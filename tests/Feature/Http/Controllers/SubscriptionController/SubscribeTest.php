<?php

declare(strict_types=1);

use App\Contracts\Actions\Subscriptions\CreatesSubscription;

it('redirects to the home page', function () {
    $this->expectToUseAction(CreatesSubscription::class);

    $this->post(route('subscribe'), [
        'email' => 'luke@foo.bar',
        'first_name' => 'Luke',
        'last_name' => 'Downing',
    ])->assertRedirect(route('home'));
});

it('includes a flash message', function () {
    $this->post(route('subscribe'), [
        'email' => 'luke@foo.bar',
        'first_name' => 'Luke',
        'last_name' => 'Downing',
    ])->assertSessionHas('message', 'Thank you for subscribing!');
});
