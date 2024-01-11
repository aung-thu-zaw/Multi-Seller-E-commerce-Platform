<?php

namespace App\Http\Controllers\Admin\Dashboard\RatingManagement;

use App\Actions\Admin\RatingManagement\ProductReviews\PermanentlyDeleteTrashedProductReviewsAction;
use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\ProductReview;
use App\Models\ProductReviewImage;
use App\Models\Scopes\FilterByScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductReviewController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:product-reviews.view', ['only' => ['index']]);
        // $this->middleware('permission:product-reviews.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-reviews.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:product-reviews.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:product-reviews.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:product-reviews.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }


    public function index(): Response|ResponseFactory
    {
        $productReviews = ProductReview::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with(['product' => function ($query) {
                    $query->select('id', 'name', 'slug', 'image')
                        ->withoutGlobalScope(FilterByScope::class);
                },'reviewer' => function ($query) {
                    $query->select('id', 'name')
                        ->withoutGlobalScope(FilterByScope::class);
                }])->filterByScope();
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/RatingManagement/ProductReviews/Index', compact('productReviews'));
    }

    public function destroy(Request $request, ProductReview $productReview): RedirectResponse
    {
        $productReview->delete();

        return to_route('admin.product-reviews.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        ProductReview::whereIn('id', $selectedItems)->delete();

        return to_route('admin.product-reviews.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedProductReviews = ProductReview::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with(['product' => function ($query) {
                    $query->select('id', 'name', 'slug', 'image')
                        ->withoutGlobalScope(FilterByScope::class);
                },'reviewer' => function ($query) {
                    $query->select('id', 'name')
                        ->withoutGlobalScope(FilterByScope::class);
                }])->filterByScope();
            })
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/RatingManagement/ProductReviews/Trash', compact('trashedProductReviews'));
    }

    public function restore(Request $request, int $trashedProductReviewId): RedirectResponse
    {
        $trashedProductReview = ProductReview::onlyTrashed()->findOrFail($trashedProductReviewId);

        $trashedProductReview->restore();

        return to_route('admin.product-reviews.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        ProductReview::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.product-reviews.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedProductReviewId): RedirectResponse
    {
        $trashedProductReview = ProductReview::onlyTrashed()->findOrFail($trashedProductReviewId);

        $productReviewImages = ProductReviewImage::where("product_review_id", $trashedProductReviewId)->get();

        $productReviewImages->each(function ($image) {

            ProductReviewImage::deleteImage($image);

            $image->delete();

        });

        $trashedProductReview->forceDelete();

        return to_route('admin.product-reviews.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedProductReviews = ProductReview::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedProductReviewsAction())->handle($trashedProductReviews);

        return to_route('admin.product-reviews.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedProductReviews = ProductReview::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedProductReviewsAction())->handle($trashedProductReviews);

        return to_route('admin.product-reviews.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
