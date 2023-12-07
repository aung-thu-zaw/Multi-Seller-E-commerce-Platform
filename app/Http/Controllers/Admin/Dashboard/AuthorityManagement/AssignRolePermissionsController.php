<?php

namespace App\Http\Controllers\Admin\Dashboard\AuthorityManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\AuthorityManagement\AssignRolePermissions\UpdateAssignRolePermissionsRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Response;
use Inertia\ResponseFactory;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignRolePermissionsController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:roles.view', ['only' => ['index']]);
        $this->middleware('permission:roles.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:roles.edit', ['only' => ['edit', 'update']]);
    }

    public function index(): Response|ResponseFactory
    {
        $rolesWithPermissions = Role::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with('permissions');
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/AuthorityManagement/AssignRolePermissions/Index', compact('rolesWithPermissions'));
    }

    public function edit(Role $role): Response|ResponseFactory
    {
        $permissionGroups = DB::table('permissions')
            ->select('group')
            ->groupBy('group')
            ->get();

        $permissions = Permission::get();

        $role->load('permissions');

        return inertia('Admin/AuthorityManagement/AssignRolePermissions/Edit', compact('role', 'permissions', 'permissionGroups'));
    }

    public function update(UpdateAssignRolePermissionsRequest $request, Role $role): RedirectResponse
    {
        $role->permissions()->detach();

        foreach ($request->permission_id as $key => $value) {
            $role->permissions()->attach(['permission_id' => $value]);
        }

        $role->users->each(function ($user) use ($role) {
            $user->syncPermissions($role->permissions);
        });

        return to_route('admin.assign-role-permissions.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Role $role): RedirectResponse
    {
        $role->permissions()->detach();

        return to_route('admin.assign-role-permissions.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }
}
