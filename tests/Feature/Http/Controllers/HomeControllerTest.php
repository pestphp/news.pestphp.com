<?php

declare(strict_types=1);

use Inertia\Testing\Assert;

it('loads the Inertia Home page', function () {
    $this->get(route('home'))
        ->assertInertia(fn (Assert $page) => $page->component('Home'));
});
