<?php

namespace App\Services;

use App\Models\SiteSetting;
use Cache;

class SiteSettingService
{
    function getSettings()
    {
        return Cache::rememberForever('settings', function () {
            return SiteSetting::pluck('value', 'key')->toArray();
        });
    }

    function setGlobalSettings()
    {
        $settings = $this->getSettings();
        config()->set('settings', $settings);
    }

    function clearCacheSetting(): void
    {
        Cache::forget('settings');
    }
}
