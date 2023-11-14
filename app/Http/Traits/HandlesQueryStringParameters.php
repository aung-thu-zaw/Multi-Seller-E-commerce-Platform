<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait HandlesQueryStringParameters
{
    /**
     * @return array<string>
     */
    protected function getQueryStringParams(Request $request): array
    {
        return [
            'search' => $request->search ?? null,
            'page' => $request->page ?? '1',
            'per_page' => $request->per_page ?? '5',
            'sort' => $request->sort ?? 'id',
            'direction' => $request->direction ?? 'desc',
            'created_from' => $request->created_from ?? null,
            'created_until' => $request->created_until ?? null,
            'deleted_from' => $request->deleted_from ?? null,
            'deleted_until' => $request->deleted_until ?? null,
            'status' => $request->status ?? null,
        ];
    }
}
