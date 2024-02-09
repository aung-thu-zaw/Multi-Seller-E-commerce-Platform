<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Actions\Admin\Coupons\PermanentlyDeleteTrashedCouponsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Coupons\StoreCouponRequest;
use App\Http\Requests\Dashboard\Admin\Coupons\UpdateCouponRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class CouponController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:coupons.view', ['only' => ['index']]);
        $this->middleware('permission:coupons.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:coupons.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:coupons.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:coupons.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:coupons.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:coupons.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $coupons = Coupon::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Coupons/Index', compact('coupons'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Coupons/Create');
    }

    public function store(StoreCouponRequest $request): RedirectResponse
    {
        Coupon::create([
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'usage_limit' => $request->usage_limit,
            'expiry_date' => $request->expiry_date,
            'status' => $request->status,
        ]);

        return to_route('admin.coupons.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Coupon $coupon): Response|ResponseFactory
    {
        return inertia('Admin/Coupons/Edit', compact('coupon'));
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon): RedirectResponse
    {
        $coupon->update([
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'usage_limit' => $request->usage_limit,
            'expiry_date' => $request->expiry_date,
            'status' => $request->status,
        ]);

        return to_route('admin.coupons.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Coupon $coupon): RedirectResponse
    {
        $coupon->delete();

        return to_route('admin.coupons.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Coupon::whereIn('id', $selectedItems)->delete();

        return to_route('admin.coupons.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedCoupons = Coupon::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Coupons/Trash', compact('trashedCoupons'));
    }

    public function restore(Request $request, int $trashedCouponId): RedirectResponse
    {
        $trashedCoupon = Coupon::onlyTrashed()->findOrFail($trashedCouponId);

        $trashedCoupon->restore();

        return to_route('admin.coupons.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Coupon::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.coupons.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedCouponId): RedirectResponse
    {
        $trashedCoupon = Coupon::onlyTrashed()->findOrFail($trashedCouponId);

        $trashedCoupon->forceDelete();

        return to_route('admin.coupons.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedCoupons = Coupon::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->get();

        (new PermanentlyDeleteTrashedCouponsAction())->handle($trashedCoupons);

        return to_route('admin.coupons.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedCoupons = Coupon::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedCouponsAction())->handle($trashedCoupons);

        return to_route('admin.coupons.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
