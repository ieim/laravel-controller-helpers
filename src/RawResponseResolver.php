<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers;

use Ieim\LaravelContracts\Contracts\ControllerHelpers\Paths\PathInterface;
use Ieim\LaravelContracts\Contracts\ControllerHelpers\RawResponseInterface;
use Ieim\LaravelContracts\Contracts\ControllerHelpers\RawResponseResolverInterface;
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

    public function toResponse(string $jsonResourceName, RawResponseInterface $response): JsonResponse
    {
        return (new $jsonResourceName($response->data()))->response();
    }
}
