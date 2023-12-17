<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Actions\Admin\Brands\UpdateFlashSaleAction;
use App\Actions\Admin\Collections\CreateFlashSaleAction;
use App\Actions\Admin\FlashSales\PermanentlyDeleteTrashedFlashSalesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\FlashSales\StoreFlashSaleRequest;
use App\Http\Requests\Dashboard\Admin\FlashSales\UpdateFlashSaleRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\FlashSale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\ResponseFactory;
use Inertia\Response;

class FlashSaleController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:flash-sales.view', ['only' => ['index']]);
        $this->middleware('permission:flash-sales.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:flash-sales.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:flash-sales.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:flash-sales.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:flash-sales.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:flash-sales.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $flashSales = FlashSale::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/FlashSales/Index', compact('flashSales'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/FlashSales/Create');
    }

    public function store(StoreFlashSaleRequest $request): RedirectResponse
    {
        (new CreateFlashSaleAction())->handle($request->validated());

        return to_route('admin.flash-sales.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(FlashSale $flashSale): Response|ResponseFactory
    {
        return inertia('Admin/FlashSales/Edit', compact('flashSale'));
    }

    public function update(UpdateFlashSaleRequest $request, FlashSale $flashSale): RedirectResponse
    {
        ( new UpdateFlashSaleAction())->handle($request->validated(), $flashSale);

        return to_route('admin.flash-sales.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, FlashSale $flashSale): RedirectResponse
    {
        $flashSale->delete();

        return to_route('admin.flash-sales.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        FlashSale::whereIn('id', $selectedItems)->delete();

        return to_route('admin.flash-sales.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedFlashSales = FlashSale::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/FlashSales/Trash', compact('trashedFlashSales'));
    }

    public function restore(Request $request, int $trashedFlashSaleId): RedirectResponse
    {
        $trashedFlashSale = FlashSale::onlyTrashed()->findOrFail($trashedFlashSaleId);

        $trashedFlashSale->restore();

        return to_route('admin.flash-sales.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        FlashSale::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.flash-sales.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedFlashSaleId): RedirectResponse
    {
        $trashedFlashSale = FlashSale::onlyTrashed()->findOrFail($trashedFlashSaleId);

        $trashedFlashSale->forceDelete();

        return to_route('admin.flash-sales.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedFlashSales = FlashSale::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedFlashSalesAction())->handle($trashedFlashSales);

        return to_route('admin.flash-sales.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedFlashSales = FlashSale::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedFlashSalesAction())->handle($trashedFlashSales);

        return to_route('admin.flash-sales.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
