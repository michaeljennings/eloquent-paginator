<?php

namespace MichaelJennings\EloquentPaginator\Tests;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use MichaelJennings\EloquentPaginator\Tests\Fixtures\Product;

class PaginateWithSelectsTest extends TestCase
{
    /**
     * @test
     */
    public function it_orders_correctly_with_a_having_clause()
    {
        $shouldNotDisplay = factory(Product::class)->create(['title' => 'Should not display', 'description' => 'Live']);
        $first = factory(Product::class)->create(['title' => 'A Product', 'description' => 'Testing']);
        $second = factory(Product::class)->create(['title' => 'Foo Product', 'description' => 'Testing']);
        $third = factory(Product::class)->create(['title' => 'Bar Product', 'description' => 'Testing']);

        $result = Product::select(['id', DB::raw("(title || ' ' || description) as full_description")])
                         ->groupBy('id')
                         ->having('full_description', 'LIKE', '%Testing')
                         ->paginateWithSelects(2);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertEquals(2, $result->count());

        $ids = $result->pluck('id')->all();

        $this->assertNotContains($shouldNotDisplay->id, $ids);
        $this->assertContains($first->id, $ids);
        $this->assertContains($second->id, $ids);
        $this->assertNotContains($third->id, $ids);
    }
}