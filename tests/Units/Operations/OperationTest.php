<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers\Tests\Operations;

use Ieim\LaravelContracts\Contracts\ControllerHelpers\Operations\OperationInterface;
use Ieim\LaravelContracts\Dummies\Contracts\ControllerHelpers\DummyCrud;
use Ieim\LaravelControllerHelpers\Tests\BaseTestCase;

class OperationTest extends BaseTestCase
{
    public function operationProvider(): array
    {
        return [
            [ new Operation() ],
        ];
    }

    public function crudProvider(): array
    {
        return [
            [ new DummyCrud() ],
        ];
    }

    /**
     * @param DummyCrud $crud
     * @dataProvider crudProvider
     */
    public function testFromCrudController(DummyCrud $crud) :void
    {
        $expected = OperationInterface::class;
        $actual = Operation::fromCrudController('', $crud);

        $this->assertInstanceOf($expected, $actual);
    }

    /**
     * @param Operation $operation
     * @dataProvider operationProvider
     */
    public function testPath(
        Operation $operation
    ) : void {

        $expected = 'dummy_current';
        $actual = $operation->current();

        $this->assertEquals($expected, $actual);
    }
}
