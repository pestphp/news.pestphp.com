<?php

declare(strict_types=1);

use Database\Factories\AuthorFactory;
use Database\Factories\PostFactory;

uses(Tests\TestCase::class)->in('Feature');

function author(): AuthorFactory
{
    return AuthorFactory::new();
}

function post(): PostFactory
{
    return PostFactory::new();
}
