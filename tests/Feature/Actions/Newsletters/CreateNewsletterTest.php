<?php

declare(strict_types=1);

use App\Actions\Newsletters\CreateNewsletter;
use App\Contracts\Actions\Newsletters\CreatesNewsletter;
use Spatie\Mailcoach\Domain\Campaign\Models\Campaign;
use Wink\WinkPost;

it('is the default implementation', function () {
    expect($this->app->make(CreatesNewsletter::class))->toBeInstanceOf(CreateNewsletter::class);
});

it('creates a newsletter', function () {
    expect(Campaign::count())->toBe(0);

    post()->count(5)->create();

    $action = $this->app->make(CreatesNewsletter::class);
    $campaign = $action->handle();

    expect(Campaign::count())->toBe(1);
    expect($campaign->subject)->toBe('Pest Newsletter');
});

it('will not create a newsletter if no posts have been published in the last week', function () {
    // This post is too old
    post()->create(['publish_date' => now()->subWeek()->subDay()]);
    // This post is for the next newsletter
    post()->create(['publish_date' => now()->addDay()]);

    $action = $this->app->make(CreatesNewsletter::class);
    $action->handle();

    expect(Campaign::count())->toBe(0);
});

it('will contain the titles and links to all posts published in the last week', function () {
    $posts = post()->count(5)->create();

    $action = $this->app->make(CreatesNewsletter::class);
    $content = $action->handle()->getHtml();

    $posts->each(fn (WinkPost $post) => expect($content)
        ->toContain($post->title)
        ->toContain(route('posts.show', $post->slug)));
});