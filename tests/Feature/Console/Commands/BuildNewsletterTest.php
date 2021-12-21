<?php

declare(strict_types=1);

use App\Contracts\Actions\Newsletters\CreatesNewsletter;
use App\Contracts\Actions\Newsletters\SendsTestNewsletter;
use App\Jobs\SendNewsletter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Queue;
use Spatie\Mailcoach\Database\Factories\CampaignFactory;

it('creates, tests and queues sending a newsletter', function () {
    Carbon::setTestNow(now()->startOfDay());
    Queue::fake();

    // A post published this week will get things working
    post()->create();
    $campaign = CampaignFactory::new()->create();

    $this->expectToUseAction(CreatesNewsletter::class)->andReturn($campaign);
    $this->expectToUseAction(SendsTestNewsletter::class);

    $this->artisan('site:newsletter', ['--force' => true]);

    Queue::assertPushed(fn (SendNewsletter $job) => now()->addHours(3)->equalTo($job->delay));
});

it('will not test or send the campaign if there is no campaign to send', function () {
    Queue::fake();

    $this->expectToUseAction(CreatesNewsletter::class)->andReturnNull();
    $this->expectNotToUseAction(SendsTestNewsletter::class);

    $this->artisan('site:newsletter', ['--force' => true])
        ->expectsOutput('There was no news to send!');

    Queue::assertNotPushed(SendNewsletter::class);
});

it('will confirm sending if --force is not set', function () {
    post()->create();

    $this->artisan('site:newsletter')
        ->expectsConfirmation('Are you sure you want to send this newsletter?');
});

it('will output the web view for the campaign', function () {
    $campaign = CampaignFactory::new()->create();

    $this->expectToUseAction(CreatesNewsletter::class)->andReturn($campaign);

    $this->artisan('site:newsletter', ['--force' => true])
        ->expectsOutput("View the newsletter in your browser: {$campaign->webviewUrl()}");
});
