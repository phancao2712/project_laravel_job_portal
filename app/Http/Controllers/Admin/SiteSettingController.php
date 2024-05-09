<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteGeneralUpdateRequest;
use App\Models\SiteSetting;
use App\Services\Notify;
use App\Services\SiteSettingService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS;

class SiteSettingController extends Controller
{
    use FileUploadTrait;
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

    function updateLogoSetting(Request $request) : RedirectResponse {
        $request->validate([
            'logo' => ['image','max:2000'],
            'favicon' => ['image','max:2000'],
        ]);

        $logoData = [];
        $logoPath = $this->uploadFile($request,'logo', config('settings.site_logo'));
        if($logoPath) $logoData['value'] = $logoPath;
        SiteSetting::updateOrCreate(
            ['key' => 'site_logo'],
            $logoData
        );
        $faviconData = [];
        $faviconPath = $this->uploadFile($request,'favicon', config('settings.site_favicon'));
        if($logoPath) $faviconData['value'] = $faviconPath;
        SiteSetting::updateOrCreate(
            ['key' => 'site_favicon'],
            $faviconData
        );

        $siteSetting = app(SiteSettingService::class);
        $siteSetting->clearCacheSetting();

        Notify::UpdateNotify();
        return redirect()->back();
    }
}
