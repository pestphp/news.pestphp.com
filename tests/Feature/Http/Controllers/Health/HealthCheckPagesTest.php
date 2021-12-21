<?php

declare(strict_types=1);

it('can access the health page', function () {
    $this->get(route('health', ['fresh' => true]))->assertOk();
});

it('can access the JSON health page', function () {
    $this->getJson(route('api.health', ['fresh' => true]))->assertOk();
});
