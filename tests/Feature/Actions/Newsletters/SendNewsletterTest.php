<?php

declare(strict_types=1);

use App\Actions\Newsletters\SendNewsletter;
use App\Contracts\Actions\Newsletters\SendsNewsletter;
use Illuminate\Support\Facades\Queue;
use Spatie\Mailcoach\Database\Factories\CampaignFactory;
use Spatie\Mailcoach\Domain\Campaign\Jobs\SendCampaignJob;

it('is the default implementation', function () {
    expect($this->app->make(SendsNewsletter::class))
        ->toBeInstanceOf(SendNewsletter::class);
});

it('sends a newsletter', function () {
    Queue::fake();

    $campaign = CampaignFactory::new()->create();

    $action = $this->app->make(SendNewsletter::class);
    $action->handle($campaign);

    Queue::assertPushed(SendCampaignJob::class);
});
