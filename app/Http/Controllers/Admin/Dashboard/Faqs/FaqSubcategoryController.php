<?php

namespace App\Http\Controllers\Admin\Dashboard\Faqs;

use App\Actions\Admin\Faqs\PermanentlyDeleteTrashedFaqSubcategoriesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Faqs\FaqSubcategories\StoreFaqSubcategoryRequest;
use App\Http\Requests\Dashboard\Admin\Faqs\FaqSubcategories\UpdateFaqSubcategoryRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\FaqCategory;
use App\Models\FaqSubcategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class FaqSubcategoryController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:faq-subcategories.view', ['only' => ['index']]);
        $this->middleware('permission:faq-subcategories.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faq-subcategories.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faq-subcategories.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:faq-subcategories.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:faq-subcategories.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:faq-subcategories.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $faqSubcategories = FaqSubcategory::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with('faqCategory');
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Faqs/FaqSubcategories/Index', compact('faqSubcategories'));
    }

    public function create(): Response|ResponseFactory
    {
        $faqCategories = FaqCategory::all();

        return inertia('Admin/Faqs/FaqSubcategories/Create', compact('faqCategories'));
    }

    public function store(StoreFaqSubcategoryRequest $request): RedirectResponse
    {
        FaqSubcategory::create(['faq_category_id' => $request->faq_category_id, 'name' => $request->name, 'icon' => $request->icon]);

        return to_route('admin.faq-subcategories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(FaqSubcategory $faqSubcategory): Response|ResponseFactory
    {
        $faqCategories = FaqCategory::all();

        return inertia('Admin/Faqs/FaqSubcategories/Edit', compact('faqSubcategory', 'faqCategories'));
    }

    public function update(UpdateFaqSubcategoryRequest $request, FaqSubcategory $faqSubcategory): RedirectResponse
    {
        $faqSubcategory->update(['faq_category_id' => $request->faq_category_id, 'name' => $request->name, 'icon' => $request->icon]);

        return to_route('admin.faq-subcategories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, FaqSubcategory $faqSubcategory): RedirectResponse
    {
        $faqSubcategory->delete();

        return to_route('admin.faq-subcategories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        FaqSubcategory::whereIn('id', $selectedItems)->delete();

        return to_route('admin.faq-subcategories.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedFaqSubcategories = FaqSubcategory::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Faqs/FaqSubcategories/Trash', compact('trashedFaqSubcategories'));
    }

    public function restore(Request $request, int $trashedFaqSubcategoryId): RedirectResponse
    {
        $trashedFaqSubcategory = FaqSubcategory::onlyTrashed()->findOrFail($trashedFaqSubcategoryId);

        $trashedFaqSubcategory->restore();

        return to_route('admin.faq-subcategories.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        FaqSubcategory::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.faq-subcategories.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedFaqSubcategoryId): RedirectResponse
    {
        $trashedFaqSubcategory = FaqSubcategory::onlyTrashed()->findOrFail($trashedFaqSubcategoryId);

        $trashedFaqSubcategory->forceDelete();

        return to_route('admin.faq-subcategories.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedFaqSubcategories = FaqSubcategory::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->get();

        (new PermanentlyDeleteTrashedFaqSubcategoriesAction())->handle($trashedFaqSubcategories);

        return to_route('admin.faq-subcategories.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedFaqSubcategories = FaqSubcategory::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedFaqSubcategoriesAction())->handle($trashedFaqSubcategories);

        return to_route('admin.faq-subcategories.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
