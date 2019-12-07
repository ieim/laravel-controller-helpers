<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers\Tests;

use Ieim\LaravelContracts\Dummies\Contracts\ControllerHelpers\DummyRawResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Mockery;

class RawResponseResolverTest extends BaseTestCase
{
    public function rawResponseResolverProvider(): array
    {
        return [
            [ new RawResponseResolver(), new DummyRawResponse() ],
        ];
    }

    /**
     * @param RawResponseResolver $rawResponseResolver
     * @param DummyRawResponse $rawResponse
     * @dataProvider rawResponseResolverProvider
     */
    public function testView(
        RawResponseResolver $rawResponseResolver,
        DummyRawResponse $rawResponse
    ) : void {

        $expected = View::class;
        $actual = $rawResponseResolver->toView($rawResponse);

        $this->assertInstanceOf($expected, $actual);
    }

    /**
     * @param RawResponseResolver $rawResponseResolver
     * @param DummyRawResponse $rawResponse
     * @dataProvider rawResponseResolverProvider
     */
    public function testJson(
        RawResponseResolver $rawResponseResolver,
        DummyRawResponse $rawResponse
    ) : void {

        Mockery::mock('Illuminate\Http\JsonResponse');

        $expected = JsonResponse::class;
        $actual = $rawResponseResolver->toJson($rawResponse);

        $this->assertInstanceOf($expected, $actual);
    }
}
