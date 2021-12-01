<?php

declare(strict_types=1);

use App\Http\Controllers\Controller;
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

it('shares flash messages', function () {
    $request = request();
    $request->setLaravelSession($this->app['session']);
    $request->session()->flash(Controller::FLASH_MESSAGE, 'Hello World!');

    $middleware = $this->app->make(HandleInertiaRequests::class);
    $data = $middleware->share($request);

    expect($data['flash']['message']())->toBe('Hello World!');
});

it('returns a null message if there is no flash message', function () {
    $request = request();
    $request->setLaravelSession($this->app['session']);

    $middleware = $this->app->make(HandleInertiaRequests::class);
    $data = $middleware->share($request);

    expect($data['flash']['message']())->toBeNull();
});
