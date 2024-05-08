<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteGeneralUpdateRequest;
use App\Models\SiteSetting;
use App\Services\Notify;
use App\Services\SiteSettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    function __construct(){
        $this->middleware(['permission: site settings']);
    }
    function index() : View {
        return view('admin.site-setting.index');
    }

    function updateGeneralSetting(SiteGeneralUpdateRequest $request) : RedirectResponse {
        $validate = $request->validated();

        foreach ($validate as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        $siteSetting = app(SiteSettingService::class);
        $siteSetting->clearCacheSetting();

        Notify::UpdateNotify();
        return redirect()->back();
    }
}
