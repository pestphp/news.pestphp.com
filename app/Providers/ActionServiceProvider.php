<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Resources\ProvidePostResource;
use App\Contracts\Actions\Resources\ProvidesPostResource;
use Illuminate\Support\ServiceProvider;

final class ActionServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string>
     */
    public array $bindings = [
        ProvidesPostResource::class => ProvidePostResource::class,
    ];
}
