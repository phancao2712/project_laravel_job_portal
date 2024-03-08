<?php

namespace App\Services;

use App\Models\PaymentSetting;
use Cache;


class PaymentGatewaySettingService
{
    function getSettings()
    {
        return Cache::rememberForever('gatewaySettings', function () {
            return PaymentSetting::pluck('value', 'key')->toArray();
        });
    }

    function setGlobalSettings()
    {
        $setting = $this->getSettings();
        config()->set('gatewaySettings', $setting);
    }

    function clearCacheSetting(): void
    {
        Cache::forget('gatewaySettings');
    }
}
