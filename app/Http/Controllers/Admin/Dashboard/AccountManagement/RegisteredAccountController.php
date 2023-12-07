<?php

namespace App\Http\Controllers\Admin\Dashboard\AccountManagement;

use App\Actions\Admin\AccountManagement\PermanentlyDeleteTrashedUsersAction;
use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class RegisteredAccountController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:registered-accounts.view', ['only' => ['index']]);
        $this->middleware('permission:registered-accounts.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:registered-accounts.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:registered-accounts.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:registered-accounts.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:registered-accounts.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:registered-accounts.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $registeredAccounts = User::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/RegisteredAccounts/Index', compact('registeredAccounts'));
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->delete();

        return to_route('admin.registered-accounts.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        User::whereIn('id', $selectedItems)->delete();

        return to_route('admin.registered-accounts.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedRegisteredAccounts = User::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/RegisteredAccounts/Trash', compact('trashedRegisteredAccounts'));
    }

    public function restore(Request $request, int $trashedRegisteredAccountId): RedirectResponse
    {
        $trashedRegisteredAccount = User::onlyTrashed()->findOrFail($trashedRegisteredAccountId);

        $trashedRegisteredAccount->restore();

        return to_route('admin.registered-accounts.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        User::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.registered-accounts.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedRegisteredAccountId): RedirectResponse
    {
        $trashedRegisteredAccount = User::onlyTrashed()->findOrFail($trashedRegisteredAccountId);

        User::deleteAvatar($trashedRegisteredAccount->avatar);

        $trashedRegisteredAccount->forceDelete();

        return to_route('admin.registered-accounts.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedRegisteredAccounts = User::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedUsersAction())->handle($trashedRegisteredAccounts);

        return to_route('admin.registered-accounts.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedRegisteredAccounts = User::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedUsersAction())->handle($trashedRegisteredAccounts);

        return to_route('admin.registered-accounts.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
