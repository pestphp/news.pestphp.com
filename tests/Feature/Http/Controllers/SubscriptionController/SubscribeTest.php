<?php

declare(strict_types=1);

use App\Contracts\Actions\Subscriptions\CreatesSubscription;

it('can subscribe a user to the mailing list', function () {
    $this->expectToUseAction(CreatesSubscription::class);

    $this->post(route('subscribe'))
        ->assertRedirect(route('home'));
});
