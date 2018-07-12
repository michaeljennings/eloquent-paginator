<?php

namespace MichaelJennings\EloquentPaginator;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class EloquentPaginatorServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function register()
    {
        Builder::macro('paginateWithSelects', function($perPage, $pageName = 'page', $page = null) {
            $page = $page ?: Paginator::resolveCurrentPage($pageName);

            $total = (clone $this)->addSelect(DB::raw('count(*) as count'))->first()->count;

            $results = $total ? $this->forPage($page, $perPage)->get() : new Collection();

            return $this->paginator($results, $total, $perPage, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]);
        });
    }
}