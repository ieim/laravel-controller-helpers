<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers;

use Ieim\LaravelContracts\Contracts\ControllerHelpers\Operations\OperationInterface;
use Ieim\LaravelContracts\Contracts\ControllerHelpers\RawResponseInterface;
use Illuminate\Support\Collection;

class RawResponse implements RawResponseInterface
{
    /**
     * @var OperationInterface
     */
    private $operation;
    /**
     * @var Collection
     */
    private $data;

    /**
     * RawResponse constructor.
     *
     * @param OperationInterface $operation
     * @param Collection $data
     */
    private function __construct(OperationInterface $operation, Collection $data)
    {
        $this->operation = $operation;
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public static function fromController(OperationInterface $operation): RawResponseInterface
    {
        return new RawResponse($operation, collect());
    }

    /**
     * @inheritDoc
     */
    public static function fromControllerWithData(
        OperationInterface $operation,
        Collection $data
    ): RawResponseInterface {

        return new RawResponse($operation, $data);
    }

    /**
     * @inheritDoc
     */
    public function data(): Collection
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function operation(): OperationInterface
    {
        return $this->operation;
    }

    /**
     * @inheritDoc
     */
    public function append(Collection $dataToMerge): void
    {
        $this->data = $this->data->merge($dataToMerge);
    }

    /**
     * @inheritDoc
     */
    public function appendAssocArray(array $dataToMerge): void
    {
        $this->data = $this->data->merge(collect($dataToMerge));
    }

    /**
     * @inheritDoc
     */
    public function reset(): void
    {
        $this->data = collect();
    }
}
