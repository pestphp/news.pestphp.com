<?php

declare(strict_types=1);

namespace App\Contracts\Actions\Models;

use Illuminate\Database\Eloquent\Builder;
use Wink\WinkPost;

interface LoadsPosts
{
    /**
     * @return Builder<WinkPost>
     */
    public function handle(): Builder;
}
