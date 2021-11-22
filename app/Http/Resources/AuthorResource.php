<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Wink\WinkAuthor;

final class AuthorResource extends JsonResource
{
    /**
     * @var WinkAuthor
     */
    public $resource;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'avatar' => $this->resource->avatar,
            'name' => $this->resource->name,
        ];
    }
}
