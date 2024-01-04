<?php

namespace App\Http\Controllers\Seller\Dashboard\OrderManagement;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\CancellationItem;
use App\Models\OrderItem;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class CancellationItemController extends Controller
{
    use HandlesQueryStringParameters;

    public function index(): Response|ResponseFactory
    {
        $storeId = Store::getStoreId();

        $cancellationItems = CancellationItem::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with(['orderItem.product:id,name,image','orderItem.order.user:id,name']);
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/OrderManagement/CancellationItems/Index', compact('cancellationItems'));
    }

    public function show(CancellationItem $cancellationItem): Response|ResponseFactory
    {
        $cancellationItem->load(['orderItem.product:id,name,image','orderItem.order.user:id,name','orderItem.order.address']);

        return inertia('Seller/OrderManagement/CancellationItems/Show', compact('cancellationItem'));
    }

    public function updateCancellationItemStatus(Request $request, CancellationItem $cancellationItem): RedirectResponse
    {
        if($request->cancellation_item_status === 'approved') {

            $cancellationItem->update(['status' => $request->cancellation_item_status,'approved_by' => auth()->id(),'cancel_approved_at' => now()]);
            OrderItem::find($cancellationItem->order_item_id)->update(["status" => "cancelled"]);

        } else {

            $cancellationItem->update(['status' => $request->cancellation_item_status]);
        }

        return back()->with('success', ':label has been successfully updated.');
    }
}
