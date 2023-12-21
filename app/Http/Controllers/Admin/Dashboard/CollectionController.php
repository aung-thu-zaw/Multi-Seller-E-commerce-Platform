<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Actions\Admin\Brands\UpdateCollectionAction;
use App\Actions\Admin\Collections\CreateCollectionAction;
use App\Actions\Admin\Collections\PermanentlyDeleteTrashedCollectionsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Collections\StoreCollectionRequest;
use App\Http\Requests\Dashboard\Admin\Collections\UpdateCollectionRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Response;
use Inertia\ResponseFactory;

class CollectionController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:collections.view', ['only' => ['index']]);
        $this->middleware('permission:collections.create', ['only' => ['create', 'store','addProduct','show',"removeProduct"]]);
        $this->middleware('permission:collections.edit', ['only' => ['edit', 'update','addProduct','show',"removeProduct"]]);
        $this->middleware('permission:collections.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:collections.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:collections.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:collections.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $collections = Collection::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Collections/Index', compact('collections'));
    }

    public function show(Collection $collection): Response|ResponseFactory
    {
        $collectionProducts = $collection->products()->select('id', 'image', 'name')->paginate(10);

        $products = Product::select("id", "name")
        ->where("status", "approved")
        ->whereDoesntHave('collections', function ($query) use ($collection) {
            $query->where('collection_id', $collection->id);
        })
        ->get();

        return inertia("Admin/Collections/Show", compact("collection", "collectionProducts", "products"));
    }

    public function addProduct(Request $request, Collection $collection): RedirectResponse
    {
        $request->validate([
            "product_id" => ["required","numeric",Rule::exists("products", "id")]
        ]);

        $collection->products()->attach($request->product_id);

        return back();
    }

    public function removeProduct(Request $request, Collection $collection): RedirectResponse
    {
        $request->validate([
            "product_id" => ["required","numeric",Rule::exists("products", "id")]
        ]);

        $collection->products()->detach($request->product_id);

        return back();
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Collections/Create');
    }

    public function store(StoreCollectionRequest $request): RedirectResponse
    {
        Collection::create(["name" => $request->name,"description" => $request->description,"status" => $request->status]);

        return to_route('admin.collections.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Collection $collection): Response|ResponseFactory
    {
        return inertia('Admin/Collections/Edit', compact('collection'));
    }

    public function update(UpdateCollectionRequest $request, Collection $collection): RedirectResponse
    {
        $collection->update(["name" => $request->name,"description" => $request->description,"status" => $request->status]);

        return to_route('admin.collections.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Collection $collection): RedirectResponse
    {
        $collection->delete();

        return to_route('admin.collections.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Collection::whereIn('id', $selectedItems)->delete();

        return to_route('admin.collections.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedCollections = Collection::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Collections/Trash', compact('trashedCollections'));
    }

    public function restore(Request $request, int $trashedCollectionId): RedirectResponse
    {
        $trashedCollection = Collection::onlyTrashed()->findOrFail($trashedCollectionId);

        $trashedCollection->restore();

        return to_route('admin.collections.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Collection::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.collections.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedCollectionId): RedirectResponse
    {
        $trashedCollection = Collection::onlyTrashed()->findOrFail($trashedCollectionId);

        $trashedCollection->forceDelete();

        return to_route('admin.collections.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedCollections = Collection::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedCollectionsAction())->handle($trashedCollections);

        return to_route('admin.collections.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedCollections = Collection::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedCollectionsAction())->handle($trashedCollections);

        return to_route('admin.collections.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
