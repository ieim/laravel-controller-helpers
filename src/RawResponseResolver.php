<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers;

use Ieim\LaravelContracts\Contracts\ControllerHelpers\RawResponseInterface;
use Ieim\LaravelContracts\Contracts\ControllerHelpers\RawResponseResolverInterface;
use Ieim\LaravelContracts\Contracts\Paths\PathInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class RawResponseResolver implements RawResponseResolverInterface
{
    /**
     * @var PathInterface
     */
    private $path;

    public function __construct(PathInterface $path)
    {
        $this->path = $path;
    }

    public function toView(RawResponseInterface $response): View
    {
        return view($this->path->toString($response->operation()), $response->data());
    }

    public function toJson(RawResponseInterface $response): JsonResponse
    {
        return response()->json($response->data());
    }

    public function toResponse(RawResponseInterface $response): JsonResponse
    {
        $jsonResourceClassName = $this->path->toResourceClassName($response->operation());
        return (new $jsonResourceClassName($response->data()))->response();
    }
}
