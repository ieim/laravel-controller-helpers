<?php declare(strict_types=1); // -*- coding: utf-8 -*-

namespace Ieim\LaravelControllerHelpers\Tests;

use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class BaseTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;
}
