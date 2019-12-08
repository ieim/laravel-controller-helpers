<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers\Dummies;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DummyCollection extends ResourceCollection
{
    public function response($request = null)
    {
        return new JsonResponse();
    }
}
