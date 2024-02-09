<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\PayoutRequest;
use App\Models\SellerBalance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class PayoutRequestController extends Controller
{
    use HandlesQueryStringParameters;

    public function index(): Response|ResponseFactory
    {
        $payoutRequests = PayoutRequest::where('seller_id', auth()->id())
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/PayoutRequests/Index', compact('payoutRequests'));
    }

    public function create(): Response|ResponseFactory
    {
        $sellerBalance = SellerBalance::where('seller_id', auth()->id())->first();

        return inertia('Seller/PayoutRequests/Create', compact('sellerBalance'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
        ]);

        $sellerBalance = SellerBalance::where('seller_id', auth()->id())->first();

        if ($sellerBalance->balance < $request->amount) {
            return back()->with('error', 'Insufficient funds. You do not have enough balance for this payout request.');
        }

        PayoutRequest::create(['seller_id' => auth()->id(), 'amount' => $request->amount, 'status' => 'pending']);

        return to_route('seller.payout-requests.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');

    }
}
