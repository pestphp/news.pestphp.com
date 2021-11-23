<?php

declare(strict_types=1);

use App\Contracts\Actions\Resources\ProvidesArticleResource;
use Inertia\Testing\Assert;

it('can display an article for a guest', function () {
    $article = post()->create();

    $this->get(route('articles.show', $article))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Article'));
});

it('will not display articles that are not set as published', function () {
    $article = post()->unpublished(now()->subDay())->create();

    $this->get(route('articles.show', $article))
        ->assertNotFound();
});

it('will not display articles that have publish_date set to a future date', function () {
    $article = post()->state(['publish_date' => now()->addDay()])->create();

    $this->get(route('articles.show', $article))
        ->assertNotFound();
});

it('uses the ProvidesArticleResource action', function () {
    $this->expectToUseAction(ProvidesArticleResource::class);

    $article = post()->create();
    $this->get(route('articles.show', $article));
});
