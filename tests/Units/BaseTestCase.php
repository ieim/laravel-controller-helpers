<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers\Tests;

use Brain\Monkey;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }
}
