<?php

namespace App\Actions\Admin\Settings;

use App\Http\Traits\ImageUpload;
use App\Models\GeneralSetting;

class UpdateGeneralSettingAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, GeneralSetting $generalSetting): void
    {
        $headerLogo = isset($data['header_logo']) && !is_string($data['header_logo']) ? $this->updateImage($data['header_logo'], $generalSetting->header_logo, 'settings') : $generalSetting->header_logo;

        $footerLogo = isset($data['footer_logo']) && !is_string($data['footer_logo']) ? $this->updateImage($data['footer_logo'], $generalSetting->footer_logo, 'settings') : $generalSetting->footer_logo;

        $favicon = isset($data['favicon']) && !is_string($data['favicon']) ? $this->updateImage($data['favicon'], $generalSetting->favicon, 'settings') : $generalSetting->favicon;

        $generalSetting->update([
            'site_name' => $data['site_name'],
            'tagline' => $data['tagline'],
            'company_phone' => $data['company_phone'],
            'company_email' => $data['company_email'],
            'company_address' => $data['company_address'],
            'support_phone' => $data['support_phone'],
            'support_email' => $data['support_email'],
            'support_address' => $data['support_address'],
            'copyright' => $data['copyright'],
            'facebook_url' => $data['facebook_url'],
            'twitter_url' => $data['twitter_url'],
            'instagram_url' => $data['instagram_url'],
            'linked_in_url' => $data['linked_in_url'],
            'youtube_url' => $data['youtube_url'],
            'header_logo' => $headerLogo,
            'footer_logo' => $footerLogo,
            'favicon' => $favicon,
        ]);
    }
}
