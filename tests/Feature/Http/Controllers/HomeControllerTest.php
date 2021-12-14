<?php

declare(strict_types=1);

use App\Contracts\Actions\Resources\ProvidesPostResource;
use Inertia\Testing\Assert;

it('loads the Inertia Home page', function () {
    $this->get(route('home'))
        ->assertInertia(fn (Assert $page) => $page->component('Home'));
});

it('sends the latest posts as a paginated collection', function () {
    $this->expectToUseAction(ProvidesPostResource::class, 'for')
        ->andReturn(['title' => 'Hello World']);

    post()->count(4)->create();

    $this->get(route('home'))
        ->assertInertia(fn (Assert $page) => $page
            ->has('posts.data', 3, fn (Assert $item) => $item
                ->where('title', 'Hello World')
            )
        );
});
