<?php

declare(strict_types=1);

use Database\Factories\AuthorFactory;
use Database\Factories\PostFactory;
use Database\Factories\TagFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Testing\Assert as PHPUnit;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\ExpectationFailedException;

uses(Tests\TestCase::class)->in('Feature');

function author(): AuthorFactory
{
    return AuthorFactory::new();
}

function post(): PostFactory
{
    return PostFactory::new();
}

function tag(): TagFactory
{
    return TagFactory::new();
}

expect()->extend('toHaveErrors', function (array $errors) {
    try {
        $this->value->__invoke();
    } catch (ValidationException $exception) {
        $actualErrors = $exception->errors();

        $errorMessage = 'The following validation errors were found:';

        foreach ($actualErrors as $actualError) {
            $errorMessage .= PHP_EOL . '- ' . json_encode($actualError);
        }

        foreach (Arr::wrap($errors) as $key => $value) {
            PHPUnit::assertArrayHasKey(
                (is_int($key)) ? $value : $key,
                $actualErrors,
                "Failed to find a validation error in session for key: '{$value}'" . PHP_EOL . PHP_EOL . $errorMessage
            );

            if (!is_int($key)) {
                $hasError = false;

                foreach (Arr::wrap($actualErrors[$key]) as $actualErrorMessage) {
                    if (Str::contains($actualErrorMessage, $value)) {
                        $hasError = true;

                        break;
                    }
                }

                if (!$hasError) {
                    PHPUnit::fail(
                        "Failed to find a validation error for key and message: '$key' => '$value'" . PHP_EOL . PHP_EOL . $errorMessage
                    );
                }
            }
        }

        return $this;
    }

    throw new ExpectationFailedException('No validation exception was thrown.');
});
