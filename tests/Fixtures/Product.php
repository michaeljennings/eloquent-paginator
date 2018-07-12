<?php

namespace MichaelJennings\EloquentPaginator\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];

    /**
     * Check if we need to run the schema.
     */
    public static function executeSchema()
    {
        $schema = Schema::connection('sqlite');

        if ( ! $schema->hasTable('products')) {
            Schema::connection('sqlite')->create('products', function ($table) {
                $table->increments('id');
                $table->string('title');
                $table->string('description');
                $table->timestamps();
            });
        }
    }
}