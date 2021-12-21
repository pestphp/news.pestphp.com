<?php

declare(strict_types=1);

namespace Tests\Doubles;

use App\Contracts\Actions\Newsletters\CreatesNewsletter;
use PHPUnit\Framework\Assert;
use Spatie\Mailcoach\Domain\Campaign\Models\Campaign;

final class FakeCreateNewsletter implements CreatesNewsletter
{
    public int $timesCalled = 0;

    public function handle(): ?Campaign
    {
        $this->timesCalled++;

        return null;
    }

    public function assertCalled(int $times): void
    {
        Assert::assertEquals($this->timesCalled, $times);
    }
}
