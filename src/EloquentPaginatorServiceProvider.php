<?php

namespace MichaelJennings\EloquentPaginator;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class EloquentPaginatorServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function register()
    {
        Builder::macro('paginateWithSelects', function($perPage) {
            $page = LengthAwarePaginator::resolveCurrentPage();
            $count = (clone $this)->addSelect(DB::raw('count(*) as count'))->first()->count;
            $clients = $this->forPage($page, $perPage)->get();

            return new LengthAwarePaginator($clients, $count, $perPage);
        });
    }
}