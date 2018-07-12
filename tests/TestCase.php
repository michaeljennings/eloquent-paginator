<?php

namespace MichaelJennings\EloquentPaginator\Tests;

use Illuminate\Support\Facades\Hash;
use MichaelJennings\EloquentPaginator\EloquentPaginatorServiceProvider;
use MichaelJennings\EloquentPaginator\Tests\Fixtures\Product;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        Hash::setRounds(4);

        Product::executeSchema();
        $this->withFactories(__DIR__.'/factories');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            EloquentPaginatorServiceProvider::class
        ];
    }
}