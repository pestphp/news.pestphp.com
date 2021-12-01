<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Resources\ProvidePostResource;
use App\Actions\Subscriptions\CreateSubscription;
use App\Actions\Subscriptions\DeleteSubscription;
use App\Contracts\Actions\Resources\ProvidesPostResource;
use App\Contracts\Actions\Subscriptions\CreatesSubscription;
use App\Contracts\Actions\Subscriptions\DeletesSubscription;
use Illuminate\Support\ServiceProvider;

final class ActionServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string>
     */
    public array $bindings = [
        ProvidesPostResource::class => ProvidePostResource::class,
        CreatesSubscription::class => CreateSubscription::class,
        DeletesSubscription::class => DeleteSubscription::class,
    ];
}
