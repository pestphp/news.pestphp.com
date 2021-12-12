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
    $this->expectToUseAction(ProvidesPostResource::class, 'for')
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

it('can displayed related posts', function () {
    $this->expectToUseAction(ProvidesPostResource::class, 'forAll')
        ->andReturn([['title' => 'My Post Title']]);

    $this->actingAs(author()->make())
        ->get(route('admin.preview', post()->create()))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Post')
            ->where('related_posts', [['title' => 'My Post Title']])
        );
});

it('limits the number of related posts to 3', function () {
    $this->actingAs(author()->make())
        ->get(route('admin.preview', post()->withRelatedPosts(4)->create()))
        ->assertInertia(fn (Assert $page) => $page
            ->component('Post')
            ->has('related_posts', 3) // 4 related posts but only 3 are loaded
        );
});
