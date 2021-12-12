<?php

declare(strict_types=1);

namespace App\Providers;

use App\Observers\WinkPostObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Spatie\Mailcoach\Domain\Audience\Models\EmailList;
use Wink\WinkPost;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmailList::class, function () {
            return EmailList::query()->firstWhere('name', 'Pest Newsletter');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();
        Model::preventLazyLoading();
        Relation::enforceMorphMap([]);
        JsonResource::withoutWrapping();

        WinkPost::observe(WinkPostObserver::class);
    }
}
