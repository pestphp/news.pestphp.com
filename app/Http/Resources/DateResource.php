<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Carbon\CarbonInterface;

final class DateResource extends JsonResource
{
    /**
     * @var CarbonInterface
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
            'diff' => $this->resource->diffForHumans(),
            'iso' => $this->resource->toIsoString(),
        ];
    }
}
