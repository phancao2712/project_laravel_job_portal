<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaypalSettingUpdateRequest;
use App\Models\PaymentSetting;
use App\Services\Notify;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentSettingController extends Controller
{
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

        Notify::UpdateNotify(); 

        return redirect()->back();
    }
}
