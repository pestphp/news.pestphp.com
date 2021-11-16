<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Preview;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Wink\WinkPost;

final class PreviewController extends Controller
{
    public function __invoke(WinkPost $post): View
    {
        return view('admin.preview', ['post' => $post]);
    }
}
