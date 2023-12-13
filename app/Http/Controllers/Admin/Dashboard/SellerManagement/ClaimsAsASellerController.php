<?php

namespace App\Http\Controllers\Admin\Dashboard\SellerManagement;

use App\Actions\Admin\SellerManagement\SellerRequests\PermanentlyDeleteTrashedSellerRequestsAction;
use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\SellerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ClaimsAsASellerController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:claims-as-a-seller.view', ['only' => ['index','show']]);
        $this->middleware('permission:claims-as-a-seller.edit', ['only' => ['changeStatus']]);
        $this->middleware('permission:claims-as-a-seller.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:claims-as-a-seller.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:claims-as-a-seller.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:claims-as-a-seller.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $sellerRequests = SellerRequest::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/SellerManagement/ClaimsAsASeller/Index', compact('sellerRequests'));
    }

    public function show(SellerRequest $sellerRequest): Response|ResponseFactory
    {
        return inertia('Admin/SellerManagement/ClaimsAsASeller/Show', compact('sellerRequest'));
    }

    public function changeStatus(Request $request, SellerRequest $sellerRequest): RedirectResponse
    {
        $sellerRequest->update(['status' => $request->status]);

        return to_route('admin.claims-as-a-seller.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, SellerRequest $sellerRequest): RedirectResponse
    {
        $sellerRequest->delete();

        return to_route('admin.claims-as-a-seller.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        SellerRequest::whereIn('id', $selectedItems)->delete();

        return to_route('admin.claims-as-a-seller.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedSellerRequests = SellerRequest::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/SellerManagement/ClaimsAsASeller/Trash', compact('trashedSellerRequests'));
    }

    public function restore(Request $request, int $trashedSellerRequestId): RedirectResponse
    {
        $trashedSellerRequest = SellerRequest::onlyTrashed()->findOrFail($trashedSellerRequestId);

        $trashedSellerRequest->restore();

        return to_route('admin.claims-as-a-seller.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        SellerRequest::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.claims-as-a-seller.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedSellerRequestId): RedirectResponse
    {
        $trashedSellerRequest = SellerRequest::onlyTrashed()->findOrFail($trashedSellerRequestId);

        $trashedSellerRequest->forceDelete();

        return to_route('admin.claims-as-a-seller.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedSellerRequests = SellerRequest::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedSellerRequestsAction())->handle($trashedSellerRequests);

        return to_route('admin.claims-as-a-seller.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedSellerRequests = SellerRequest::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedSellerRequestsAction())->handle($trashedSellerRequests);

        return to_route('admin.claims-as-a-seller.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
