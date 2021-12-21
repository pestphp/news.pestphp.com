<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\HorizonCheck;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Facades\Health;

final class LaravelHealthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Health::checks([
            PingCheck::new()->url('/')->label('Homepage'),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            HorizonCheck::new(),
            DatabaseCheck::new(),
            RedisCheck::new(),
            ScheduleCheck::new(),
        ]);
    }
}
