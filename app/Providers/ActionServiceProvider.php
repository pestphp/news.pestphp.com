<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Newsletters\CreateNewsletter;
use App\Actions\Newsletters\SendTestNewsletter;
use App\Actions\Resources\ProvidePostResource;
use App\Actions\Subscriptions\CreateSubscription;
use App\Actions\Subscriptions\DeleteSubscription;
use App\Contracts\Actions\Newsletters\CreatesNewsletter;
use App\Contracts\Actions\Newsletters\SendsTestNewsletter;
use App\Contracts\Actions\Resources\ProvidesPostResource;
use App\Contracts\Actions\Subscriptions\CreatesSubscription;
use App\Contracts\Actions\Subscriptions\DeletesSubscription;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Spatie\Mailcoach\Domain\Audience\Models\EmailList;

final class ActionServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string>
     */
    public array $bindings = [
        ProvidesPostResource::class => ProvidePostResource::class,
        CreatesSubscription::class => CreateSubscription::class,
        DeletesSubscription::class => DeleteSubscription::class,
        CreatesNewsletter::class => CreateNewsletter::class,
        SendsTestNewsletter::class => SendTestNewsletter::class,
    ];

    public function register(): void
    {
        $this->app->bind(CreateNewsletter::class, function (Application $app) {
            return new CreateNewsletter(
                $app->make(Dispatcher::class),
                $app->make(EmailList::class),
                $app->make('config')->get('mail.from.address'),
            );
        });
    }
}
