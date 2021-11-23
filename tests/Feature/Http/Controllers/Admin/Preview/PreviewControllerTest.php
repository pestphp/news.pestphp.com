<?php

declare(strict_types=1);

use App\Contracts\Actions\Resources\ProvidesPostResource;
use Inertia\Testing\Assert;

it('allows an author to view a preview post', function () {
    $author = author()->create();
    $post = post()->forAuthor($author)->create();

    $this->actingAs($author)
        ->get(route('admin.preview', $post))
        ->assertOk();
});

it('cannot be accessed by a guest', function () {
    $this->get(route('admin.preview', post()->create()))
        ->assertRedirect('/wink');
});

it('returns the Post vue component', function () {
    $author = author()->create();
    $post = post()->forAuthor($author)->create();

    $this->actingAs($author)
        ->get(route('admin.preview', $post))
        ->assertInertia(fn (Assert $page) => $page
            ->component('Post')
            ->has('post')
        );
});

it('uses the ProvidesPostResource action', function () {
    $this->expectToUseAction(ProvidesPostResource::class);

    $author = author()->create();
    $post = post()->forAuthor($author)->create();
    $this->actingAs($author)->get(route('admin.preview', $post));
});