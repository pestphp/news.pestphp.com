<?php

declare(strict_types=1);

it('will auto-generate an excerpt on save if one does not exist', function () {
    // Check create
    $post = post()->create(['excerpt' => '']);
    expect($post->excerpt)->not->toHaveLength(0);

    // Check update
    $post->fill(['excerpt' => ''])->update();
    expect($post->excerpt)->not->toHaveLength(0);
});
