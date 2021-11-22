<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;

abstract class JsonResource extends BaseJsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function forInertia(Request $request): array
    {
        return $this->toResponse($request)->getData(true);
    }
}
