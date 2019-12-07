<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers\Tests\Operations;


use Ieim\LaravelContracts\Contracts\ControllerHelpers\Operations\OperationInterface;

class Operation implements OperationInterface
{
    /**
     * @inheritDoc
     */
    public static function fromCrudController(string $operation): OperationInterface
    {
        return new Operation($operation);
    }

    /**
     * @inheritDoc
     */
    public function current(): string
    {
        // TODO: Implement current() method.
    }
}
