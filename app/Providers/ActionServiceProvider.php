<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Models\LoadRelatedPosts\LoadRelatedPosts;
use App\Actions\Models\LoadRelatedPosts\LoadRelatedPublishedPosts;
use App\Actions\Models\LoadRelatedPosts\LoadRelatedPublishedPostsAsProphet;
use App\Actions\Resources\ProvidePostResource;
use App\Actions\Subscriptions\CreateSubscription;
use App\Actions\Subscriptions\DeleteSubscription;
use App\Contracts\Actions\Models\LoadsRelatedPosts;
use App\Contracts\Actions\Resources\ProvidesPostResource;
use App\Contracts\Actions\Subscriptions\CreatesSubscription;
use App\Contracts\Actions\Subscriptions\DeletesSubscription;
use App\Http\Controllers\Admin\Preview\PreviewController;
use App\Http\Controllers\PostController;
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
        LoadsRelatedPosts::class => LoadRelatedPosts::class,
    ];

    public function register(): void
    {
        $this->app->when(PostController::class)
            ->needs(LoadsRelatedPosts::class)
            ->give(LoadRelatedPublishedPosts::class);

        $this->app->when(PreviewController::class)
            ->needs(LoadsRelatedPosts::class)
            ->give(LoadRelatedPublishedPostsAsProphet::class);
    }
}
