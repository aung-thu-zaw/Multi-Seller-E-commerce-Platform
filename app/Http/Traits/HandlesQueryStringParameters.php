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
        ];
    }
}
