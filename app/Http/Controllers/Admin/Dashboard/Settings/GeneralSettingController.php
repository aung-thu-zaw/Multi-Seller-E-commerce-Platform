<?php

namespace App\Http\Controllers\Admin\Dashboard\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Settings\GeneralSettingRequest;
use App\Models\GeneralSetting;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class GeneralSettingController extends Controller
{
    public function edit(): Response|ResponseFactory
    {
        $generalSettings = GeneralSetting::all();

        return inertia("Admin/Settings/GeneralSettings/Edit", compact("generalSettings"));
    }

    public function update(GeneralSettingRequest $request): RedirectResponse
    {
        foreach ($request->all() as $key => $value) {

            GeneralSetting::updateOrCreate(['key' => $key], ['value' => $value]);

        }

        return back()->with('success', ':label has been successfully updated.');
    }
}
