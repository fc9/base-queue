<?php

namespace Fc9\Queue\Tests;

use Orchestra\Testbench\TestCase;
use Fc9\Queue\QueueServiceProvider;

class ExampleTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [QueueServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
