<?php

namespace App\Http\Controllers\Admin\Dashboard\AuthorityManagement;

use App\Actions\Admin\AuthorityManagement\PermanentlyDeleteTrashedRolesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\AuthorityManagement\Roles\StoreRoleRequest;
use App\Http\Requests\Dashboard\Admin\AuthorityManagement\Roles\UpdateRoleRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:roles.view', ['only' => ['index']]);
        $this->middleware('permission:roles.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:roles.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:roles.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:roles.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:roles.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:roles.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $roles = Role::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/AuthorityManagement/Roles/Index', compact('roles'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/AuthorityManagement/Roles/Create');
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        Role::create(['name' => $request->name]);

        return to_route('admin.roles.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Role $role): Response|ResponseFactory
    {
        return inertia('Admin/AuthorityManagement/Roles/Edit', compact('role'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->update(['name' => $request->name]);

        return to_route('admin.roles.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Role $role): RedirectResponse
    {
        $role->delete();

        return to_route('admin.roles.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Role::whereIn('id', $selectedItems)->delete();

        return to_route('admin.roles.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedRoles = Role::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/AuthorityManagement/Roles/Trash', compact('trashedRoles'));
    }

    public function restore(Request $request, int $trashedRoleId): RedirectResponse
    {
        $trashedRole = Role::onlyTrashed()->findOrFail($trashedRoleId);

        $trashedRole->restore();

        return to_route('admin.roles.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Role::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.roles.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedRoleId): RedirectResponse
    {
        $trashedRole = Role::onlyTrashed()->findOrFail($trashedRoleId);

        $trashedRole->forceDelete();

        return to_route('admin.roles.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedRoles = Role::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedRolesAction())->handle($trashedRoles);

        return to_route('admin.roles.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedRoles = Role::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedRolesAction())->handle($trashedRoles);

        return to_route('admin.roles.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
