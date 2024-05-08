<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaypalSettingUpdateRequest;
use App\Http\Requests\RazorpayUpdateRequest;
use App\Http\Requests\StripeSettingUpdateRequest;
use App\Models\PaymentSetting;
use App\Services\Notify;
use App\Services\PaymentGatewaySettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentSettingController extends Controller
{
    function __construct(){
        $this->middleware(['permission: payment settings']);
    }
    function index() : View {
        return view('admin.payment-setting.index');
    }

    function updatePaypalSetting(PaypalSettingUpdateRequest $request) : RedirectResponse {
        $validate = $request->validated();
        foreach ($validate as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        $settingService = app(PaymentGatewaySettingService::class);
        $settingService->clearCacheSetting();

        Notify::UpdateNotify();

        return redirect()->back();
    }

    function updateStripeSetting(StripeSettingUpdateRequest $request) {
        $validate = $request->validated();
        foreach ($validate as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        $settingService = app(PaymentGatewaySettingService::class);
        $settingService->clearCacheSetting();

        Notify::UpdateNotify();

        return redirect()->back();
    }

    function updateRazorpaySetting(RazorpayUpdateRequest $request) {
        $validate = $request->validated();
        foreach ($validate as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        $settingService = app(PaymentGatewaySettingService::class);
        $settingService->clearCacheSetting();

        Notify::UpdateNotify();

        return redirect()->back();
    }
}
