<?php

declare(strict_types=1);

use App\Actions\Newsletters\SendTestNewsletter;
use App\Contracts\Actions\Newsletters\SendsTestNewsletter;
use Illuminate\Support\Facades\Queue;
use Spatie\Mailcoach\Database\Factories\CampaignFactory;
use Spatie\Mailcoach\Domain\Campaign\Jobs\SendCampaignTestJob;
use Wink\WinkAuthor;

it('is the default implementation', function () {
    expect($this->app->make(SendsTestNewsletter::class))
        ->toBeInstanceOf(SendTestNewsletter::class);
});

it('sends all authors a test newsletter', function () {
    Queue::fake();

    $authors = author()->count(3)->create();
    $campaign = CampaignFactory::new()->create();

    $action = $this->app->make(SendTestNewsletter::class);
    $action->handle($campaign);

    $authors->each(fn (WinkAuthor $author) => Queue::assertPushed(fn (SendCampaignTestJob $job) => $job->email === $author->email));
});
