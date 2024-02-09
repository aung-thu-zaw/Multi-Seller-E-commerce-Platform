<?php

namespace App\Http\Controllers\Admin\Dashboard\SubscribersAndNewsletters;

use App\Actions\Admin\Subscribers\PermanentlyDeleteTrashedSubscribersAction;
use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class SubscriberController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:subscribers.view', ['only' => ['index']]);
        $this->middleware('permission:subscribers.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:subscribers.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:subscribers.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:subscribers.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $subscribers = Subscriber::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Subscribers/Index', compact('subscribers'));
    }

    public function destroy(Request $request, Subscriber $subscriber): RedirectResponse
    {
        $subscriber->delete();

        return to_route('admin.subscribers.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Subscriber::whereIn('id', $selectedItems)->delete();

        return to_route('admin.subscribers.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedSubscribers = Subscriber::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Subscribers/Trash', compact('trashedSubscribers'));
    }

    public function restore(Request $request, int $trashedSubscriberId): RedirectResponse
    {
        $trashedSubscriber = Subscriber::onlyTrashed()->findOrFail($trashedSubscriberId);

        $trashedSubscriber->restore();

        return to_route('admin.subscribers.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Subscriber::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.subscribers.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedSubscriberId): RedirectResponse
    {
        $trashedSubscriber = Subscriber::onlyTrashed()->findOrFail($trashedSubscriberId);

        $trashedSubscriber->forceDelete();

        return to_route('admin.subscribers.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedSubscribers = Subscriber::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedSubscribersAction())->handle($trashedSubscribers);

        return to_route('admin.subscribers.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedSubscribers = Subscriber::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedSubscribersAction())->handle($trashedSubscribers);

        return to_route('admin.subscribers.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
