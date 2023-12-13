<?php

namespace App\Http\Controllers\Admin\Dashboard\SellerManagement;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ClaimsAsASellerController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:claim-as-a-seller.view', ['only' => ['index','show']]);
        $this->middleware('permission:claim-as-a-seller.edit', ['only' => ['changeStatus']]);
        $this->middleware('permission:claim-as-a-seller.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:claim-as-a-seller.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:claim-as-a-seller.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:claim-as-a-seller.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $requests = Store::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/SellerManagement/ClaimsAsASeller/Index', compact('requests'));
    }

    public function show(Store $store): Response|ResponseFactory
    {
        return inertia('Admin/SellerManagement/ClaimsAsASeller/Show', compact('store'));
    }

    public function changeStatus(Request $request, Store $store): RedirectResponse
    {
        $store->update(['status' => $request->status === 'active' ? 'suspended' : 'active']);

        return to_route('admin.claims-as-a-seller.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Store $store): RedirectResponse
    {
        $store->delete();

        return to_route('admin.claims-as-a-seller.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Store::whereIn('id', $selectedItems)->delete();

        return to_route('admin.claims-as-a-seller.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    // public function trashed(): Response|ResponseFactory
    // {
    //     $trashedRegisteredAccounts = User::search(request('search'))
    //         ->onlyTrashed()
    //         ->orderBy(request('sort', 'id'), request('direction', 'desc'))
    //         ->paginate(request('per_page', 5))
    //         ->appends(request()->all());

    //     return inertia('Admin/AccountManagement/RegisteredAccounts/Trash', compact('trashedRegisteredAccounts'));
    // }

    // public function restore(Request $request, int $trashedRegisteredAccountId): RedirectResponse
    // {
    //     $trashedRegisteredAccount = User::onlyTrashed()->findOrFail($trashedRegisteredAccountId);

    //     $trashedRegisteredAccount->restore();

    //     return to_route('admin.claims-as-a-seller.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    // }

    // public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    // {
    //     $selectedItems = explode(',', $selectedItems);

    //     User::onlyTrashed()
    //         ->whereIn('id', $selectedItems)
    //         ->restore();

    //     return to_route('admin.claims-as-a-seller.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    // }

    // public function forceDelete(Request $request, int $trashedRegisteredAccountId): RedirectResponse
    // {
    //     $trashedRegisteredAccount = User::onlyTrashed()->findOrFail($trashedRegisteredAccountId);

    //     User::deleteAvatar($trashedRegisteredAccount->avatar);

    //     $trashedRegisteredAccount->forceDelete();

    //     return to_route('admin.claims-as-a-seller.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    // }

    // public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    // {
    //     $selectedItems = explode(',', $selectedItems);

    //     $trashedRegisteredAccounts = User::onlyTrashed()->whereIn('id', $selectedItems)->get();

    //     (new PermanentlyDeleteTrashedUsersAction())->handle($trashedRegisteredAccounts);

    //     return to_route('admin.claims-as-a-seller.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    // }

    // public function forceDeleteAll(Request $request): RedirectResponse
    // {
    //     $trashedRegisteredAccounts = User::onlyTrashed()->get();

    //     (new PermanentlyDeleteTrashedUsersAction())->handle($trashedRegisteredAccounts);

    //     return to_route('admin.claims-as-a-seller.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    // }
}
