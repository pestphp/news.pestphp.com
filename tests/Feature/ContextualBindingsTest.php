<?php

declare(strict_types=1);

use App\Actions\Models\LoadRelatedPosts\LoadRelatedPublishedPosts;
use App\Actions\Models\LoadRelatedPosts\LoadRelatedPublishedPostsAsProphet;
use App\Contracts\Actions\Models\LoadsRelatedPosts;
use App\Http\Controllers\Admin\Preview\PreviewController;
use App\Http\Controllers\PostController;

it('gives the Post Controller the LoadRelatedPublishedPosts action', function () {
    expect($this->app->contextual[PostController::class][LoadsRelatedPosts::class])->toBe(LoadRelatedPublishedPosts::class);
});

it('gives the Preview Controller the LoadRelatedPublishedPostsAsProphet action', function () {
    expect($this->app->contextual[PreviewController::class][LoadsRelatedPosts::class])->toBe(LoadRelatedPublishedPostsAsProphet::class);
});
