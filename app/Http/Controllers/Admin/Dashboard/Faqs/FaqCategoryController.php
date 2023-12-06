<?php

namespace App\Http\Controllers\Admin\Dashboard\Faqs;

use App\Actions\Admin\Faqs\FaqCategories\PermanentlyDeleteTrashedFaqCategoriesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Faqs\FaqCategories\StoreFaqCategoryRequest;
use App\Http\Requests\Dashboard\Admin\Faqs\FaqCategories\UpdateFaqCategoryRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\FaqCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class FaqCategoryController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:categories.view', ['only' => ['index']]);
        $this->middleware('permission:categories.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:categories.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:categories.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:categories.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:categories.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:categories.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $faqCategories = FaqCategory::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Faqs/Categories/Index', compact('faqCategories'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Faqs/Categories/Create');
    }

    public function store(StoreFaqCategoryRequest $request): RedirectResponse
    {
        FaqCategory::create(["name" => $request->name]);

        return to_route('admin.faq-categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(FaqCategory $faqCategory): Response|ResponseFactory
    {
        return inertia('Admin/Faqs/Categories/Edit', compact('faqCategory'));
    }

    public function update(UpdateFaqCategoryRequest $request, FaqCategory $faqCategory): RedirectResponse
    {
        $faqCategory->update(["name" => $request->name]);

        return to_route('admin.faq-categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, FaqCategory $faqCategory): RedirectResponse
    {
        $faqCategory->delete();

        return to_route('admin.faq-categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        FaqCategory::whereIn('id', $selectedItems)->delete();

        return to_route('admin.faq-categories.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedFaqCategories = FaqCategory::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Faqs/Categories/Trash', compact('trashedFaqCategories'));
    }

    public function restore(Request $request, int $trashedFaqCategoryId): RedirectResponse
    {
        $trashedFaqCategory = FaqCategory::onlyTrashed()->findOrFail($trashedFaqCategoryId);

        $trashedFaqCategory->restore();

        return to_route('admin.faq-categories.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        FaqCategory::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.faq-categories.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedFaqCategoryId): RedirectResponse
    {
        $trashedFaqCategory = FaqCategory::onlyTrashed()->findOrFail($trashedFaqCategoryId);

        $trashedFaqCategory->forceDelete();

        return to_route('admin.faq-categories.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedFaqCategories = FaqCategory::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->get();

        (new PermanentlyDeleteTrashedFaqCategoriesAction())->handle($trashedFaqCategories);

        return to_route('admin.faq-categories.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedFaqCategories = FaqCategory::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedFaqCategoriesAction())->handle($trashedFaqCategories);

        return to_route('admin.faq-categories.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
