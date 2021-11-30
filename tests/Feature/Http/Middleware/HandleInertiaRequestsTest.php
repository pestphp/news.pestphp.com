<?php

declare(strict_types=1);

use App\Http\Middleware\HandleInertiaRequests;

it('shares the logged in user', function () {
    $this->be(author()->make([
        'name' => 'Nuno Maduro',
        'avatar' => 'https://foo.com',
    ]));

    $middleware = $this->app->make(HandleInertiaRequests::class);
    $data = $middleware->share(request());

    expect($data['user']())
        ->name->toBe('Nuno Maduro')
        ->avatar->toBe('https://foo.com');
});

it('shares null if no user is logged in', function () {
    $middleware = $this->app->make(HandleInertiaRequests::class);
    $data = $middleware->share(request());

    expect($data['user']())->toBeNull();
});
