<?php

declare(strict_types=1);

use App\Contracts\Actions\Resources\ProvidesPostResource;
use Inertia\Testing\Assert;

it('can display a post for a guest', function () {
    $this->expectToUseAction(ProvidesPostResource::class, 'for')
        ->andReturn(['title' => 'My Post Title']);

    $this->get(route('posts.show', post()->create()))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Post')
            ->where('post', ['title' => 'My Post Title'])
        );
});

it('will not display posts that are not published', function (array $state) {
    $post = post()->state($state)->create();

    $this->get(route('posts.show', $post))
        ->assertNotFound();
})->with([
    [['publish_date' => now()->subDay(), 'published' => false]],
    [['publish_date' => now()->addDay(), 'published' => true]],
]);

it('can displayed related posts', function () {
    $this->expectToUseAction(ProvidesPostResource::class, 'forAll')
        ->andReturn([['title' => 'My Post Title']]);

    $this->get(route('posts.show', post()->create()))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Post')
            ->where('related_posts', [['title' => 'My Post Title']])
        );
});

it('limits the number of related posts to 4', function () {
    $this->get(route('posts.show', post()->withRelatedPosts(4)->create()))
        ->assertInertia(fn (Assert $page) => $page
            ->component('Post')
            ->has('related_posts', 3) // 4 related posts but only 3 are loaded
        );
});
