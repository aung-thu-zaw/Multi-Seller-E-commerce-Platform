<?php

namespace App\Http\Controllers\Admin\Dashboard\AccountManagement;

use App\Actions\Admin\AccountManagement\PermanentlyDeleteTrashedUsersAction;
use App\Actions\Admin\AdminManage\CreateAdminAction;
use App\Actions\Admin\AdminManage\UpdateAdminAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\AccountManagement\AdminMange\StoreAdminRequest;
use App\Http\Requests\Dashboard\Admin\AccountManagement\AdminMange\UpdateAdminRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class AdminManageController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:admin-manage.view', ['only' => ['index']]);
        $this->middleware('permission:admin-manage.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin-manage.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin-manage.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:admin-manage.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:admin-manage.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:admin-manage.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $admins = User::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/AccountManagement/AdminMange/Index', compact('admins'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/AccountManagement/AdminMange/Create');
    }

    public function store(StoreAdminRequest $request): RedirectResponse
    {
        (new CreateAdminAction())->handle($request->validated());

        return to_route('admin.admin-manage.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(User $user): Response|ResponseFactory
    {
        return inertia('Admin/AccountManagement/AdminMange/Edit', compact('user'));
    }

    public function update(UpdateAdminRequest $request, User $user): RedirectResponse
    {
        (new UpdateAdminAction())->handle($request->validated(), $user);

        return to_route('admin.admin-manage.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->delete();

        return to_route('admin.admin-manage.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        User::whereIn('id', $selectedItems)->delete();

        return to_route('admin.admin-manage.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedAdmins = User::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/AccountManagement/AdminMange/Trash', compact('trashedAdmins'));
    }

    public function restore(Request $request, int $trashedAdminId): RedirectResponse
    {
        $trashedAdmin = User::onlyTrashed()->findOrFail($trashedAdminId);

        $trashedAdmin->restore();

        return to_route('admin.admin-manage.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        User::onlyTrashed()
               ->whereIn('id', $selectedItems)
               ->restore();

        return to_route('admin.admin-manage.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedAdminId): RedirectResponse
    {
        $trashedAdmin = User::onlyTrashed()->findOrFail($trashedAdminId);

        User::deleteAvatar($trashedAdmin->avatar);

        $trashedAdmin->forceDelete();

        return to_route('admin.admin-manage.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedAdmins = User::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedUsersAction())->handle($trashedAdmins);

        return to_route('admin.admin-manage.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedAdmins = User::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedUsersAction())->handle($trashedAdmins);

        return to_route('admin.admin-manage.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
