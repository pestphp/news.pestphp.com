<?php

declare(strict_types=1);

use App\Contracts\Actions\Resources\ProvidesPostResource;
use Inertia\Testing\Assert;

it('can display a post for a guest', function () {
    $this->expectToUseAction(ProvidesPostResource::class)
        ->andReturn(['title' => 'My Post Title']);

    $this->get(route('posts.show', post()->create()))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Post')
            ->where('post', ['title' => 'My Post Title'])
        );
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
