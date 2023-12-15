<?php

namespace App\Http\Controllers\Admin\Dashboard\Banners;

use App\Actions\Admin\Banners\CampaignBanners\PermanentlyDeleteTrashedCampaignBannersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Banners\CampaignBanners\StoreCampaignBannerRequest;
use App\Http\Requests\Dashboard\Admin\Banners\CampaignBanners\UpdateCampaignBannerRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Http\Traits\ImageUpload;
use App\Models\CampaignBanner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class CampaignBannerController extends Controller
{
    use HandlesQueryStringParameters;
    use ImageUpload;

    public function __construct()
    {
        $this->middleware('permission:campaign-banners.view', ['only' => ['index']]);
        $this->middleware('permission:campaign-banners.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:campaign-banners.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:campaign-banners.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:campaign-banners.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:campaign-banners.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:campaign-banners.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $campaignBanners = CampaignBanner::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Banners/CampaignBanners/Index', compact('campaignBanners'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Banners/CampaignBanners/Create');
    }

    public function store(StoreCampaignBannerRequest $request): RedirectResponse
    {
        $image = isset($request->image) ? $this->createImage($request->image, 'campaign-banners') : null;

        CampaignBanner::create([
            "url" => $request->url,
            "status" => $request->status,
            "image" => $image,
        ]);

        return to_route('admin.campaign-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(CampaignBanner $campaignBanner): Response|ResponseFactory
    {
        return inertia('Admin/Banners/CampaignBanners/Edit', compact('campaignBanner'));
    }

    public function update(UpdateCampaignBannerRequest $request, CampaignBanner $campaignBanner): RedirectResponse
    {
        $image = isset($request->image) && !is_string($request->image) ? $this->updateImage($request->image, $campaignBanner->image, 'campaign-banners') : $campaignBanner->image;

        $campaignBanner->update([
            "url" => $request->url,
            "status" => $request->status,
            "image" => $image,
        ]);

        return to_route('admin.campaign-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, CampaignBanner $campaignBanner): RedirectResponse
    {
        $campaignBanner->delete();

        return to_route('admin.campaign-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        CampaignBanner::whereIn('id', $selectedItems)->delete();

        return to_route('admin.campaign-banners.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedCampaignBanners = CampaignBanner::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Banners/CampaignBanners/Trash', compact('trashedCampaignBanners'));
    }

    public function restore(Request $request, int $trashedCampaignBannerId): RedirectResponse
    {
        $trashedCampaignBanner = CampaignBanner::onlyTrashed()->findOrFail($trashedCampaignBannerId);

        $trashedCampaignBanner->restore();

        return to_route('admin.campaign-banners.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        CampaignBanner::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.campaign-banners.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedCampaignBannerId): RedirectResponse
    {
        $trashedCampaignBanner = CampaignBanner::onlyTrashed()->findOrFail($trashedCampaignBannerId);

        CampaignBanner::deleteImage($trashedCampaignBanner->image);

        $trashedCampaignBanner->forceDelete();

        return to_route('admin.campaign-banners.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedCampaignBanners = CampaignBanner::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedCampaignBannersAction())->handle($trashedCampaignBanners);

        return to_route('admin.campaign-banners.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedCampaignBanners = CampaignBanner::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedCampaignBannersAction())->handle($trashedCampaignBanners);

        return to_route('admin.campaign-banners.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
