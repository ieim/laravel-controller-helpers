<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers;

use Ieim\LaravelContracts\Contracts\ControllerHelpers\RawResponseInterface;
use Ieim\LaravelContracts\Contracts\ControllerHelpers\RawResponseResolverInterface;
use Ieim\LaravelContracts\Contracts\Paths\PathInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Webmozart\Assert\Assert;

class RawResponseResolver implements RawResponseResolverInterface
{
    /**
     * @var PathInterface
     */
    private $path;

    /**
     * RawResponseResolver constructor.
     * @param PathInterface $path
     */
    public function __construct(PathInterface $path)
    {
        $this->path = $path;
    }

    /**
     * @param RawResponseInterface $response
     * @return View
     */
    public function toView(RawResponseInterface $response): View
    {
        $result = view($this->path->resolve($response->operation()), $response->data());
        Assert::isInstanceOf($result, View::class);
        return $result;
    }

    /**
     * @param RawResponseInterface $response
     * @return JsonResponse
     */
    public function toJson(RawResponseInterface $response): JsonResponse
    {
        $result = response()->json($response->data());
        Assert::isInstanceOf($result, JsonResponse::class);
        return $result;
    }

    /**
     * @param RawResponseInterface $response
     * @return JsonResponse
     */
    public function toResponse(RawResponseInterface $response): JsonResponse
    {
        $jsonResourceClassName = $this->path->resolve($response->operation());
        $resource = new $jsonResourceClassName($response->data());
        Assert::isInstanceOf($resource, JsonResource::class);
        return $resource->response();
    }
}
