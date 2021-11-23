<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Resources\ProvideArticleResource;
use App\Contracts\Actions\Resources\ProvidesArticleResource;
use Illuminate\Support\ServiceProvider;

final class ActionServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string>
     */
    public array $bindings = [
        ProvidesArticleResource::class => ProvideArticleResource::class,
    ];
}
