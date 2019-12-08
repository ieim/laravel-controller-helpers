<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers\Tests\Operations;

use Ieim\LaravelContracts\Contracts\ControllerHelpers\Operations\OperationInterface;
use Ieim\LaravelControllerHelpers\Operations\Operation;
use Ieim\LaravelControllerHelpers\Tests\BaseTestCase;

class OperationTest extends BaseTestCase
{
    public function operationProvider(): array
    {
        $operationName = OperationInterface::OPERATION_INDEX;
        $operations = collect(OperationInterface::OPERATIONS_CRUD);

        return [
            [ new Operation($operationName, $operations), $operationName ],
        ];
    }

    public function falseyOperationProvider(): array
    {
        $operationName = 'not_an_operation';
        $operations = collect(OperationInterface::OPERATIONS_CRUD);

        return [
            [ new Operation($operationName, $operations), $operationName ],
        ];
    }

    /**
     * @param Operation $operation
     * @param string $operationName
     * @dataProvider operationProvider
     */
    public function testFromCrudController(
        Operation $operation,
        string $operationName
    ) :void {

        $expected = OperationInterface::class;
        $actual = Operation::fromCrudController($operationName);

        $this->assertInstanceOf($expected, $actual);
    }

    /**
     * @param Operation $operation
     * @param string $operationName
     * @dataProvider falseyOperationProvider
     */
    public function testFromCrudControllerFalseyOperation(
        Operation $operation,
        string $operationName
    ) :void {

        $this->expectErrorMessage(Operation::INVALID_CRUD_OPERATION_RECEIVED);
        $actual = Operation::fromCrudController($operationName);
    }

    /**
     * @param Operation $operation
     * @param string $operationName
     * @dataProvider operationProvider
     */
    public function testCurrent(
        Operation $operation,
        string $operationName
    ) : void {

        $expected = $operationName;
        $actual = $operation->current();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @param Operation $operation
     * @param string $operationName
     * @dataProvider operationProvider
     */
    public function testIsValidWhenItIs(
        Operation $operation,
        string $operationName
    ) : void {

        $actual = $operation->isValid();

        $this->assertTrue($actual);
    }

    /**
     * @param Operation $operation
     * @param string $operationName
     * @dataProvider falseyOperationProvider
     */
    public function testIsNotValidWhenItIsNot(
        Operation $operation,
        string $operationName
    ) : void {

        $actual = $operation->isValid();

        $this->assertFalse($actual);
    }

    /**
     * @param Operation $operation
     * @dataProvider operationProvider
     */
    public function testOperations(
        Operation $operation
    ) : void {

        $expected = collect(OperationInterface::OPERATIONS_CRUD);
        $actual = $operation->operations();

        $this->assertEquals($expected, $actual);
    }
}
