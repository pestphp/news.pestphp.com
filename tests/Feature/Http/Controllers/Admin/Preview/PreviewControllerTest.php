<?php

declare(strict_types=1);

use App\Contracts\Actions\Resources\ProvidesPostResource;
use Inertia\Testing\Assert;

it('allows an author to view an unpublished post', function () {
    $author = author()->create();
    $post = post()->unpublished()->forAuthor($author)->create();

    $this->actingAs($author)
        ->get(route('admin.preview', $post))
        ->assertOk();
});

it('cannot be accessed by a guest', function () {
    $this->get(route('admin.preview', post()->create()))
        ->assertRedirect('/wink');
});

it('returns the Post vue component', function () {
    $this->expectToUseAction(ProvidesPostResource::class)
        ->andReturn(['title' => 'Hello World']);

    $author = author()->create();
    $post = post()->forAuthor($author)->create();

    $this->actingAs($author)
        ->get(route('admin.preview', $post))
        ->assertInertia(fn (Assert $page) => $page
            ->component('Post')
            ->where('post', ['title' => 'Hello World'])
            ->where('preview', true)
        );
});
