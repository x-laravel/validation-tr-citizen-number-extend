<?php

namespace XLaravel\ValidationTrCitizenNumberExtend\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use XLaravel\ValidationTrCitizenNumberExtend\TrCitizenNumberServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [TrCitizenNumberServiceProvider::class];
    }
}
