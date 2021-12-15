<?php

declare(strict_types=1);

namespace Tests;

use Database\Seeders\EmailListSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;

    protected function afterRefreshingDatabase(): void
    {
        $this->artisan('migrate', [
            '--path' => 'vendor/themsaid/wink/src/Migrations',
        ]);

        $this->seed(EmailListSeeder::class);
    }

    /**
     * @param class-string $action
     */
    protected function expectToUseAction(string $action, string $method = 'handle')
    {
        return $this->spy($action)->shouldReceive($method)->atLeast()->once();
    }
}
