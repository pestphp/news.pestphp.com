<?php

declare(strict_types=1);

use App\Contracts\Actions\Resources\ProvidesArticleResource;
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

it('returns the Article vue component', function () {
    $author = author()->create();
    $post = post()->forAuthor($author)->create();

    $this->actingAs($author)
        ->get(route('admin.preview', $post))
        ->assertInertia(fn (Assert $page) => $page
            ->component('Article')
            ->has('article')
        );
});

it('uses the ProvidesArticleResource action', function () {
    $this->expectToUseAction(ProvidesArticleResource::class);

    $author = author()->create();
    $post = post()->forAuthor($author)->create();
    $this->actingAs($author)->get(route('admin.preview', $post));
});
