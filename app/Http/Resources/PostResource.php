<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Wink\WinkPost;

final class PostResource extends JsonResource
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
        $content = $this->resource->content instanceof HtmlString
            ? $this->resource->content->toHtml()->getContent()
            : $this->resource->content;

        return [
            'id' => $this->resource->id,
            'slug' => $this->resource->slug,
            'featured_image' => $this->resource->featured_image,
            'featured_image_caption' => $this->resource->featured_image_caption,
            'title' => $this->resource->title,
            'content' => $content,
            'excerpt' => $this->resource->excerpt,
            'is_published' => $this->resource->published && $this->resource->publish_date->isPast(),
            'publish_date' => DateResource::make($this->resource->publish_date),
            'read_time' => Str::of($content)->stripTags()->wordCount() / 200,
            'author' => AuthorResource::make($this->resource->author),
        ];
    }
}
