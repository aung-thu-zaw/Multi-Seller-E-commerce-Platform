<?php

namespace App\Http\Controllers\Admin\Dashboard\RatingManagement;

use App\Actions\Admin\RatingManagement\AutomatedFilterWords\PermanentlyDeleteTrashedAutomatedFilterWordsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\RatingManagement\AutomatedFilterWords\StoreAutomatedFilterWordRequest;
use App\Http\Requests\Dashboard\Admin\RatingManagement\AutomatedFilterWords\UpdatedAutomatedFilterWordRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\AutomatedFilterWord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class AutomatedFilterWordController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:automated-filter-words.view', ['only' => ['index']]);
        $this->middleware('permission:automated-filter-words.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:automated-filter-words.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:automated-filter-words.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:automated-filter-words.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:automated-filter-words.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:automated-filter-words.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $automatedFilterWords = AutomatedFilterWord::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/RatingManagement/AutomatedFilterWords/Index', compact('automatedFilterWords'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/RatingManagement/AutomatedFilterWords/Create');
    }

    public function store(StoreAutomatedFilterWordRequest $request): RedirectResponse
    {
        AutomatedFilterWord::create(["word" => $request->word]);

        return to_route('admin.automated-filter-words.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(AutomatedFilterWord $automatedFilterWord): Response|ResponseFactory
    {
        return inertia('Admin/RatingManagement/AutomatedFilterWords/Edit', compact('automatedFilterWord'));
    }

    public function update(UpdatedAutomatedFilterWordRequest $request, AutomatedFilterWord $automatedFilterWord): RedirectResponse
    {
        $automatedFilterWord->update(["word" => $request->word]);

        return to_route('admin.automated-filter-words.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, AutomatedFilterWord $automatedFilterWord): RedirectResponse
    {
        $automatedFilterWord->delete();

        return to_route('admin.automated-filter-words.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        AutomatedFilterWord::whereIn('id', $selectedItems)->delete();

        return to_route('admin.automated-filter-words.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedAutomatedFilterWords = AutomatedFilterWord::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/RatingManagement/AutomatedFilterWords/Trash', compact('trashedAutomatedFilterWords'));
    }

    public function restore(Request $request, int $trashedAutomatedFilterWordId): RedirectResponse
    {
        $trashedAutomatedFilterWord = AutomatedFilterWord::onlyTrashed()->findOrFail($trashedAutomatedFilterWordId);

        $trashedAutomatedFilterWord->restore();

        return to_route('admin.automated-filter-words.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        AutomatedFilterWord::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.automated-filter-words.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedAutomatedFilterWordId): RedirectResponse
    {
        $trashedAutomatedFilterWord = AutomatedFilterWord::onlyTrashed()->findOrFail($trashedAutomatedFilterWordId);

        $trashedAutomatedFilterWord->forceDelete();

        return to_route('admin.automated-filter-words.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedAutomatedFilterWords = AutomatedFilterWord::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedAutomatedFilterWordsAction())->handle($trashedAutomatedFilterWords);

        return to_route('admin.automated-filter-words.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedAutomatedFilterWords = AutomatedFilterWord::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedAutomatedFilterWordsAction())->handle($trashedAutomatedFilterWords);

        return to_route('admin.automated-filter-words.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
