<?php

namespace App\Http\Controllers\Admin\Dashboard\SellerManagement;

use App\Actions\Admin\SellerManagement\StoreManage\PermanentlyDeleteTrashedStoresAction;
use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class StoreManageController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:store-manage.view', ['only' => ['index', 'show']]);
        $this->middleware('permission:store-manage.edit', ['only' => ['changeStatus']]);
        $this->middleware('permission:store-manage.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:store-manage.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:store-manage.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:store-manage.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $stores = Store::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/SellerManagement/StoreManage/Index', compact('stores'));
    }

    public function show(Store $store): Response|ResponseFactory
    {
        return inertia('Admin/SellerManagement/StoreManage/Show', compact('store'));
    }

    public function changeStatus(Request $request, Store $store): RedirectResponse
    {
        $store->update(['status' => $request->status]);

        // $user = User::findOrFail($sellerRequest->user_id);

        // if ($request->status === 'approved') {

        //     (new SellerVerificationService())->handleApproval($user, $sellerRequest);

        // } elseif ($request->status === 'rejected') {

        //     (new SellerVerificationService())->handleRejection($user, $request->reason_for_rejection);
        // }

        return to_route('admin.store-manage.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Store $store): RedirectResponse
    {
        $store->delete();

        return to_route('admin.store-manage.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Store::whereIn('id', $selectedItems)->delete();

        return to_route('admin.store-manage.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedStores = Store::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/SellerManagement/StoreManage/Trash', compact('trashedStores'));
    }

    public function restore(Request $request, int $trashedStoreId): RedirectResponse
    {
        $trashedStore = Store::onlyTrashed()->findOrFail($trashedStoreId);

        $trashedStore->restore();

        return to_route('admin.store-manage.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Store::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.store-manage.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedStoreId): RedirectResponse
    {
        $trashedStore = Store::onlyTrashed()->findOrFail($trashedStoreId);

        Store::deleteAvatar($trashedStore->avatar);

        Store::deleteCover($trashedStore->cover);

        $trashedStore->forceDelete();

        return to_route('admin.store-manage.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedStores = Store::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->get();

        (new PermanentlyDeleteTrashedStoresAction())->handle($trashedStores);

        return to_route('admin.store-manage.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedStores = Store::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedStoresAction())->handle($trashedStores);

        return to_route('admin.store-manage.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
