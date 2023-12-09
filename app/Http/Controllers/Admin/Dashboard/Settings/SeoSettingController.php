<?php

namespace App\Http\Controllers\Admin\Dashboard\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Settings\SeoSettingRequest;
use App\Models\SeoSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class SeoSettingController extends Controller
{
    public function edit(): Response|ResponseFactory
    {
        $seoSetting = SeoSetting::findOrFail(1);

        return inertia('Admin/Settings/SeoSettings/Edit', compact('seoSetting'));
    }

    public function update(SeoSettingRequest $request, SeoSetting $seoSetting): RedirectResponse
    {
        $seoSetting->update([
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
        ]);

        return back()->with('success', ':label has been successfully updated.');
    }
}
