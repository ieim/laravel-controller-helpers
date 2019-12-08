<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers\Tests;

use Exception;
use Ieim\LaravelContracts\Contracts\ControllerHelpers\RawResponseInterface;
use Ieim\LaravelContracts\Dummies\Contracts\ControllerHelpers\Operations\DummyOperation;
use Ieim\LaravelControllerHelpers\RawResponse;
use Illuminate\Support\Collection;

class RawResponseTest extends BaseTestCase
{
    public function rawResponseProvider(): array
    {
        $data = collect(['test' => true]);
        $operation = new DummyOperation();

        return [
            [ RawResponse::fromControllerWithData($operation, $data), $operation, $data ],
        ];
    }

    /**
     * @param RawResponse $rawResponse
     * @param DummyOperation $operation
     * @dataProvider rawResponseProvider
     */
    public function testFromController(RawResponse $rawResponse, DummyOperation $operation) :void
    {
        $expected = RawResponseInterface::class;
        $actual = RawResponse::fromController($operation);

        $this->assertInstanceOf($expected, $actual);
    }

    /**
     * @param RawResponse $rawResponse
     * @param DummyOperation $operation
     * @dataProvider rawResponseProvider
     */
    public function testFromControllerWithData(
        RawResponse $rawResponse,
        DummyOperation $operation,
        Collection $data
    ) :void {

        $expected = RawResponseInterface::class;
        $actual = RawResponse::fromControllerWithData($operation, $data);

        $this->assertInstanceOf($expected, $actual);
        $this->assertEquals($data, $actual->data());
    }

    /**
     * @param RawResponse $rawResponse
     * @dataProvider rawResponseProvider
     */
    public function testData(
        RawResponse $rawResponse,
        DummyOperation $dummyOperation,
        Collection $data
    ) : void {

        $expected = $data;
        $actual = $rawResponse->data();

        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @param RawResponse $rawResponse
     * @throws Exception
     * @dataProvider rawResponseProvider
     */
    public function testAppend(
        RawResponse $rawResponse,
        DummyOperation $operation,
        Collection $data
    ) : void {

        $append = collect(['test2' => true]);
        $expected = $data->merge($append);
        $rawResponse->append($append);
        $actual = $rawResponse->data();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @param RawResponse $rawResponse
     * @throws Exception
     * @dataProvider rawResponseProvider
     */
    public function testAppendAssocArray(
        RawResponse $rawResponse,
        DummyOperation $operation,
        Collection $data
    ) : void {

        $append = ['test2' => true];
        $expected = $data->merge(collect($append));
        $rawResponse->appendAssocArray($append);
        $actual = $rawResponse->data();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @param RawResponse $rawResponse
     * @throws Exception
     * @dataProvider rawResponseProvider
     */
    public function testReset(
        RawResponse $rawResponse
    ) : void {

        $expected = collect();
        $rawResponse->reset();
        $actual = $rawResponse->data();
        $this->assertEquals($expected, $actual);
    }
}
