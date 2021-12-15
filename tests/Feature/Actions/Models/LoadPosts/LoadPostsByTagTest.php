<?php

declare(strict_types=1);

use App\Actions\Models\LoadPosts\LoadPostsByTag;
use App\Actions\Models\LoadPosts\LoadPublishedPosts;
use Wink\WinkTag;

it('limits the given posts to those with the specified tags', function () {
    $fooTag = tag()->create(['slug' => 'foo']);
    $barTag = tag()->create(['slug' => 'bar']);

    $fooPost = post()->hasTags($fooTag)->create();
    $barPost = post()->hasTags($barTag)->create();
    $foobarPost = post()->hasTags(WinkTag::all())->create();

    $postsWithoutTag = post()->count(2)->create();

    $action = new LoadPostsByTag(['tags' => ['foo', 'bar']]);

    expect($action->handle()->get())
        ->toHaveCount(3);
});

it('can be passed a custom builder', function () {
    $tag = tag()->create();
    $unpublishedPost = post()->unpublished()->hasTags($tag)->create();
    $publishedPost = post()->hasTags($tag)->create();

    // We pass the LoadPublishedPosts builder so there should be no unpublished posts
    $action = new LoadPostsByTag(['tags' => [$tag->slug]], (new LoadPublishedPosts())->handle());

    expect($action->handle()->get())
        ->toHaveCount(1)
        ->first()->is($publishedPost)->toBeTrue();
});

it('loads all tags if an empty array is passed', function () {
    $fooTag = tag()->create(['slug' => 'foo']);
    $barTag = tag()->create(['slug' => 'bar']);

    $fooPost = post()->hasTags($fooTag)->create();
    $barPost = post()->hasTags($barTag)->create();
    $foobarPost = post()->hasTags(WinkTag::all())->create();
    $postsWithoutTag = post()->count(2)->create();

    $action = new LoadPostsByTag(['tags' => []]);

    expect($action->handle()->get())->toHaveCount(5);
});

it('requires valid data', function (mixed $data, array $errors) {
    $action = new LoadPostsByTag($data);

    expect(fn () => $action->handle())->toHaveErrors($errors);
})->with([
    'not an array' => [['tags' => null], ['tags' => 'array']],
    'tag doesn\'t exist in database' => [['tags' => ['foo']], ['tags.0' => 'in']],
]);
