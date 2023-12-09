<?php

namespace App\Http\Controllers\Admin\Dashboard\Settings;

use App\Actions\Admin\Settings\UpdateGeneralSettingAction;
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
        $generalSetting = GeneralSetting::findOrFail(1);

        return inertia("Admin/Settings/GeneralSettings/Edit", compact("generalSetting"));
    }

    public function update(GeneralSettingRequest $request, GeneralSetting $generalSetting): RedirectResponse
    {
        (new UpdateGeneralSettingAction())->handle($request->validated(), $generalSetting);

        return back()->with('success', ':label has been successfully updated.');
    }
}
