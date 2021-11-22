<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Preview;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Response;
use Wink\WinkPost;

final class PreviewController extends Controller
{
    public function __invoke(WinkPost $post): Response
    {
        $content = $post->content->toHtml()->getContent();

        return inertia('Article', [
            'article' => [
                'featured_image' => $post->featured_image,
                'featured_image_caption' => $post->featured_image_caption,
                'title' => $post->title,
                'publish_date' => [
                    'display' => $post->publish_date->diffForHumans(),
                    'iso' => $post->publish_date->toIsoString(),
                ],
                'read_time' => Str::of($content)->stripTags()->wordCount() / 200,
                'author' => [
                    'avatar' => $post->author->avatar,
                    'name' => $post->author->name
                ],
                'content' => $content,
            ],
        ]);
    }
}
