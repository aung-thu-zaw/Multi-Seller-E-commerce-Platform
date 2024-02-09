<?php

namespace App\Http\Controllers\Admin\Dashboard\AuthorityManagement;

use App\Http\Controllers\Controller;
use Inertia\Response;
use Inertia\ResponseFactory;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permissions.view', ['only' => ['index']]);
    }

    public function index(): Response|ResponseFactory
    {
        $permissions = Permission::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/AuthorityManagement/Permissions/Index', compact('permissions'));
    }
}
