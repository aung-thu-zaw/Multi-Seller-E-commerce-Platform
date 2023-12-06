<?php

namespace App\Http\Controllers\Admin\Dashboard\Faqs;

use App\Actions\Admin\Faqs\PermanentlyDeleteTrashedFaqContentsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Faqs\FaqContents\StoreFaqContentRequest;
use App\Http\Requests\Dashboard\Admin\Faqs\FaqContents\UpdateFaqContentRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\FaqContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class FaqContentController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:faq-contents.view', ['only' => ['index']]);
        $this->middleware('permission:faq-contents.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faq-contents.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faq-contents.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:faq-contents.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:faq-contents.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:faq-contents.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $faqContents = FaqContent::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Faqs/FaqContents/Index', compact('faqContents'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Faqs/FaqContents/Create');
    }

    public function store(StoreFaqContentRequest $request): RedirectResponse
    {
        FaqContent::create([
            "faq_subcategory_id" => $request->faq_subcategory_id,
            "question" => $request->question,
            "answer" => $request->answer,
        ]);

        return to_route('admin.faq-contents.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(FaqContent $faqContent): Response|ResponseFactory
    {
        return inertia('Admin/Faqs/FaqContents/Edit', compact('faqContent'));
    }

    public function update(UpdateFaqContentRequest $request, FaqContent $faqContent): RedirectResponse
    {
        $faqContent->update([
            "faq_subcategory_id" => $request->faq_subcategory_id,
            "question" => $request->question,
            "answer" => $request->answer,
        ]);

        return to_route('admin.faq-contents.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, FaqContent $faqContent): RedirectResponse
    {
        $faqContent->delete();

        return to_route('admin.faq-contents.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        FaqContent::whereIn('id', $selectedItems)->delete();

        return to_route('admin.faq-contents.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedFaqContents = FaqContent::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Faqs/FaqContents/Trash', compact('trashedFaqContents'));
    }

    public function restore(Request $request, int $trashedFaqContentId): RedirectResponse
    {
        $trashedFaqContent = FaqContent::onlyTrashed()->findOrFail($trashedFaqContentId);

        $trashedFaqContent->restore();

        return to_route('admin.faq-contents.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        FaqContent::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.faq-contents.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedFaqContentId): RedirectResponse
    {
        $trashedFaqContent = FaqContent::onlyTrashed()->findOrFail($trashedFaqContentId);

        $trashedFaqContent->forceDelete();

        return to_route('admin.faq-contents.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedFaqContents = FaqContent::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->get();

        (new PermanentlyDeleteTrashedFaqContentsAction())->handle($trashedFaqContents);

        return to_route('admin.faq-contents.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedFaqContents = FaqContent::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedFaqContentsAction())->handle($trashedFaqContents);

        return to_route('admin.faq-contents.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
