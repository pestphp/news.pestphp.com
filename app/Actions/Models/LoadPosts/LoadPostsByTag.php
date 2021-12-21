<?php

declare(strict_types=1);

namespace App\Actions\Models\LoadPosts;

use App\Contracts\Actions\Models\LoadsPosts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Wink\WinkPost;

final class LoadPostsByTag implements LoadsPosts
{
    /**
     * @var Builder<WinkPost>
     */
    private Builder $builder;

    /**
     * @param array<string, mixed> $data
     * @param ?Builder<WinkPost>   $builder
     */
    public function __construct(
        private array $data,
        Builder $builder = null
    ) {
        $this->builder = $builder ?? (new LoadPosts())->handle();
    }

    /**
     * @throws ValidationException
     */
    public function handle(): Builder
    {
        $data = Validator::validate($this->data, [
            'tags' => ['array'],
            'tags.*' => ['string', 'exists:wink_tags,slug'],
        ]);

        return $this->builder->when(
            count($data['tags']) > 0,
            fn ($query) => $query->whereHas('tags', fn (Builder $query) => $query->whereIn('slug', $data['tags']))
        );
    }
}
