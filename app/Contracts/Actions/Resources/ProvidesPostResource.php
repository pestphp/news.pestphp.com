<?php

declare(strict_types=1);

namespace App\Contracts\Actions\Resources;

use Illuminate\Http\Request;
use Wink\WinkPost;

interface ProvidesPostResource
{
    /**
     * @return array<string, mixed>
     */
    public function for(WinkPost $post, Request $request): array;
}
