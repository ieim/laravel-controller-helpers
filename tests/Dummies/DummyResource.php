<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers\Dummies;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class DummyResource extends JsonResource
{
    public function response($request = null)
    {
        return new JsonResponse();
    }
}
