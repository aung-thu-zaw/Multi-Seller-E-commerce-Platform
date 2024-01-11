<?php

namespace App\Http\Controllers\Admin\Dashboard\RatingManagement;

use App\Actions\Admin\RatingManagement\StoreReviews\PermanentlyDeleteTrashedStoreReviewsAction;
use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Scopes\FilterByScope;
use App\Models\StoreReview;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class StoreReviewController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:store-reviews.view', ['only' => ['index']]);
        // $this->middleware('permission:store-reviews.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:store-reviews.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:store-reviews.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:store-reviews.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:store-reviews.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }


    public function index(): Response|ResponseFactory
    {
        $storeReviews = StoreReview::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with(['store','reviewer' => function ($query) {
                    $query->select('id', 'name')
                        ->withoutGlobalScope(FilterByScope::class);
                }])->filterByScope();
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/RatingManagement/StoreReviews/Index', compact('storeReviews'));
    }

    public function destroy(Request $request, StoreReview $storeReview): RedirectResponse
    {
        $storeReview->delete();

        return to_route('admin.store-reviews.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        StoreReview::whereIn('id', $selectedItems)->delete();

        return to_route('admin.store-reviews.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedStoreReviews = StoreReview::search(request('search'))
        ->query(function (Builder $builder) {
            $builder->with(['store','reviewer' => function ($query) {
                $query->select('id', 'name')
                    ->withoutGlobalScope(FilterByScope::class);
            }])->filterByScope();
        })
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/RatingManagement/StoreReviews/Trash', compact('trashedStoreReviews'));
    }

    public function restore(Request $request, int $trashedStoreReviewId): RedirectResponse
    {
        $trashedStoreReview = StoreReview::onlyTrashed()->findOrFail($trashedStoreReviewId);

        $trashedStoreReview->restore();

        return to_route('admin.store-reviews.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        StoreReview::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.store-reviews.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedStoreReviewId): RedirectResponse
    {
        $trashedStoreReview = StoreReview::onlyTrashed()->findOrFail($trashedStoreReviewId);

        $trashedStoreReview->forceDelete();

        return to_route('admin.store-reviews.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedStoreReviews = StoreReview::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedStoreReviewsAction())->handle($trashedStoreReviews);

        return to_route('admin.store-reviews.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedStoreReviews = StoreReview::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedStoreReviewsAction())->handle($trashedStoreReviews);

        return to_route('admin.store-reviews.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
