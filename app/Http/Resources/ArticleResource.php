<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Wink\WinkPost;

final class ArticleResource extends JsonResource
{
    /**
     * @var WinkPost
     */
    public $resource;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $content = $this->resource->content->toHtml()->getContent();

        return [
            'id' => $this->resource->id,
            'featured_image' => $this->resource->featured_image,
            'featured_image_caption' => $this->resource->featured_image_caption,
            'title' => $this->resource->title,
            'content' => $content,
            'publish_date' => DateResource::make($this->resource->publish_date),
            'read_time' => Str::of($content)->stripTags()->wordCount() / 200,
            'author' => AuthorResource::make($this->resource->author),
        ];
    }
}
