<?php

declare(strict_types=1);

use App\Contracts\Actions\Resources\ProvidesPostResource;
use Inertia\Testing\Assert;

it('can display an post for a guest', function () {
    $post = post()->create();

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Post'));
});

it('will not display posts that are not set as published', function () {
    $post = post()->unpublished(now()->subDay())->create();

    $this->get(route('posts.show', $post))
        ->assertNotFound();
});

it('will not display posts that have publish_date set to a future date', function () {
    $post = post()->state(['publish_date' => now()->addDay()])->create();

    $this->get(route('posts.show', $post))
        ->assertNotFound();
});

it('uses the ProvidesPostResource action', function () {
    $this->expectToUseAction(ProvidesPostResource::class);

    $post = post()->create();
    $this->get(route('posts.show', $post));
});
