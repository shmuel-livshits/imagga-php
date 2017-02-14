<?php

namespace Fab\Imagga\Tests;

use Mockery;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }
}
