<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers\Operations;

use Ieim\LaravelContracts\Contracts\ControllerHelpers\Operations\OperationInterface;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class Operation implements OperationInterface
{
    const INVALID_CRUD_OPERATION_RECEIVED = 'Invalid crud operation received.';

    private $operation;

    /**
     * @var Collection
     */
    private $operations;

    /**
     * Operation constructor.
     *
     * @param string $operation
     */
    public function __construct(string $operation, Collection $operations)
    {
        $this->operation = $operation;
        $this->operations = $operations;
    }

    /**
     * @inheritDoc
     */
    public static function fromCrudController(string $operation): OperationInterface
    {
        $operations = collect(OperationInterface::OPERATIONS_CRUD);

        if (! $operations->containsStrict($operation)) {
            throw new InvalidArgumentException(self::INVALID_CRUD_OPERATION_RECEIVED);
        }

        return new Operation($operation, $operations);
    }

    /**
     * @inheritDoc
     */
    public function current(): string
    {
        return $this->operation;
    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return $this->operations->containsStrict($this->operation);
    }

    /**
     * @inheritDoc
     */
    public function operations(): Collection
    {
        return $this->operations;
    }
}
