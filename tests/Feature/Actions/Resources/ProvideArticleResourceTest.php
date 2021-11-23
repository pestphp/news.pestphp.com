<?php

declare(strict_types=1);

use App\Actions\Resources\ProvidePostResource;
use App\Contracts\Actions\Resources\ProvidesPostResource;

it('is the bound default in the container', function () {
    expect($this->app->make(ProvidesPostResource::class))
        ->toBeInstanceOf(ProvidePostResource::class);
});

it("formats an posts's basic properties correctly", function (array $state, string $key, $value) {
    $post = post()->create($state);

    $action = $this->app->make(ProvidePostResource::class);
    $result = $action->handle($post, request());

    expect($result[$key])->toBe($value);
})->with([
    [['title' => 'Hello World'], 'title', 'Hello World'],
    [['featured_image' => '/storage/some-fake-file.png'], 'featured_image', '/storage/some-fake-file.png'],
    [['featured_image_caption' => 'Pest in Practice'], 'featured_image_caption', 'Pest in Practice'],
    [['body' => 'Foo bar baz', 'markdown' => false], 'content', 'Foo bar baz'],
    [['body' => '# Foo bar baz', 'markdown' => true], 'content', "<h1>Foo bar baz</h1>\n"],
    [['publish_date' => now()->subDay()->startOfDay()], 'publish_date', ['diff' => '1 day ago', 'iso' => now()->subDay()->startOfDay()->toISOString()]],
    [['body' => 'foo bar baz'], 'read_time', 0.015],
]);

it("formats an post's author correctly", function () {
    $author = author()->create([
        'avatar' => 'https://pestphp.com/avatars/luke',
        'name' => 'Luke Downing',
    ]);
    $post = post()->forAuthor($author)->create();

    $action = $this->app->make(ProvidePostResource::class);
    $result = $action->handle($post, request());

    expect($result['author'])
        ->id->toBe($author->id)
        ->avatar->toBe('https://pestphp.com/avatars/luke')
        ->name->toBe('Luke Downing');
});
