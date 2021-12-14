<?php

declare(strict_types=1);

use App\Actions\Resources\ProvidePostResource;
use App\Actions\Subscriptions\CreateSubscription;
use App\Actions\Subscriptions\DeleteSubscription;
use App\Contracts\Actions\Resources\ProvidesPostResource;
use App\Contracts\Actions\Subscriptions\CreatesSubscription;
use App\Contracts\Actions\Subscriptions\DeletesSubscription;

it('is the bound default in the container', function (string $contract, string $default) {
    expect($this->app->make($contract))->toBeInstanceOf($default);
})->with([
    [ProvidesPostResource::class, ProvidePostResource::class],
    [CreatesSubscription::class, CreateSubscription::class],
    [DeletesSubscription::class, DeleteSubscription::class],
]);
