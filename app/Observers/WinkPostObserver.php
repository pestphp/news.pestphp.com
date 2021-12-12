<?php

declare(strict_types=1);

namespace App\Observers;

use Illuminate\Support\Str;
use Wink\WinkPost;

final class WinkPostObserver
{
    public function saving(WinkPost $post): void
    {
        if (!empty($post->excerpt)) {
            return;
        }

        $post->excerpt = Str::limit(strip_tags($post->body));
    }
}
