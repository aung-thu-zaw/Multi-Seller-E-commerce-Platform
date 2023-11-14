<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FilterByScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  Builder<Model>  $builder
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->when(request('created_from'), function ($query, $createdFrom) {
            $query->whereDate('created_at', '>=', $createdFrom);
        })
        ->when(request('created_until'), function ($query, $createdUntil) {
            $query->whereDate('created_at', '<=', $createdUntil);
        })
        ->when(request('deleted_from'), function ($query, $deletedFrom) {
            $query->whereDate('deleted_at', '>=', $deletedFrom);
        })
        ->when(request('deleted_until'), function ($query, $deletedUntil) {
            $query->whereDate('deleted_at', '<=', $deletedUntil);
        })
        ->when(request('filter_by_status'), function ($query, $filterByStatus) {
            $query->where('status', $filterByStatus);
        });
    }
}
