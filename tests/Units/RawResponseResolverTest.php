<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers\Tests;

use Brain\Monkey\Functions;
use Ieim\LaravelContracts\Dummies\Contracts\ControllerHelpers\DummyRawResponse;
use Ieim\LaravelContracts\Dummies\Contracts\ControllerHelpers\Paths\DummyPath;
use Ieim\LaravelControllerHelpers\Dummies\DummyCollection;
use Ieim\LaravelControllerHelpers\Dummies\DummyResource;
use Ieim\LaravelControllerHelpers\RawResponseResolver;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Mockery;

class RawResponseResolverTest extends BaseTestCase
{
    public function rawResponseResolverProvider(): array
    {
        return [
            [
                new RawResponseResolver(new DummyPath()),
                new DummyRawResponse(),
            ],
        ];
    }

    /**
     * @param RawResponseResolver $rawResponseResolver
     * @param DummyRawResponse $rawResponse
     * @dataProvider rawResponseResolverProvider
     */
    public function testToView(
        RawResponseResolver $rawResponseResolver,
        DummyRawResponse $rawResponse
    ) : void {

        $viewMock = Mockery::mock('Illuminate\Contracts\View\View');
        Functions\when('view')->justReturn($viewMock);

        $expected = View::class;
        $actual = $rawResponseResolver->toView($rawResponse);

        $this->assertInstanceOf($expected, $actual);
    }

    /**
     * @param RawResponseResolver $rawResponseResolver
     * @param DummyRawResponse $rawResponse
     * @dataProvider rawResponseResolverProvider
     */
    public function testToJson(
        RawResponseResolver $rawResponseResolver,
        DummyRawResponse $rawResponse
    ) : void {

        $responseFactoryMock = Mockery::mock('Illuminate\Contracts\Routing\ResponseFactory');
        $jsonResponseMock = Mockery::mock('Illuminate\Http\JsonResponse');
        $responseFactoryMock->shouldReceive('json')
            ->andReturn($jsonResponseMock);

        Functions\when('response')
            ->justReturn($responseFactoryMock);

        $expected = JsonResponse::class;
        $actual = $rawResponseResolver->toJson($rawResponse);

        $this->assertInstanceOf($expected, $actual);
    }

    /**
     * @param RawResponseResolver $rawResponseResolver
     * @param DummyRawResponse $rawResponse
     * @dataProvider rawResponseResolverProvider
     */
    public function testToResponse(
        RawResponseResolver $rawResponseResolver,
        DummyRawResponse $rawResponse
    ) : void {

        $jsonResponseMock = Mockery::mock('Illuminate\Http\JsonResponse');
        $jsonResourceMock = Mockery::mock('Illuminate\Http\Resources\Json\JsonResource');
        $jsonResourceMock->shouldReceive('response')
            ->andReturn($jsonResponseMock);

        $expected = JsonResponse::class;
        $actual = $rawResponseResolver->toResponse(DummyResource::class, $rawResponse);

        $this->assertInstanceOf($expected, $actual);
    }

    /**
     * @param RawResponseResolver $rawResponseResolver
     * @param DummyRawResponse $rawResponse
     * @dataProvider rawResponseResolverProvider
     */
    public function testToResponseFromCollection(
        RawResponseResolver $rawResponseResolver,
        DummyRawResponse $rawResponse
    ) : void {

        $jsonResponseMock = Mockery::mock('Illuminate\Http\JsonResponse');
        $jsonCollectionMock = Mockery::mock('Illuminate\Http\Resources\Json\ResourceCollection');
        $jsonCollectionMock->shouldReceive('response')
            ->andReturn($jsonResponseMock);

        $expected = JsonResponse::class;
        $actual = $rawResponseResolver->toResponse(DummyCollection::class, $rawResponse);

        $this->assertInstanceOf($expected, $actual);
    }
}
