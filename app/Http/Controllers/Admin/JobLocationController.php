<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\JobLocation;
use App\Models\Province;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobLocationController extends Controller
{
    use FileUploadTrait;
    function __construct(){
        $this->middleware(['permission: sections']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $jobLocations = JobLocation::paginate(10);
        return view('admin.job_location.index',compact(
            'jobLocations'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.job_location.create', compact(
            'countries'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'province_id' => ['required'],
            'country_id' => ['required'],
            'image' => ['required','max:2500']
        ]);
        $data = [];
        $imagePath = $this->uploadFile($request,'image');
        if($imagePath) $data['image'] = $imagePath;
        $data['province_id'] = $request->province_id;
        $data['country_id'] = $request->country_id;
        $data['status'] = $request->status;

        JobLocation::create(
            $data
        );
        Notify::CreateNotify();
        return to_route('admin.job-location.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobLocation = JobLocation::findOrFail($id);
        $countries = Country::all();
        $provinces = Province::where('country_id',$jobLocation->country_id)->get();
        return view('admin.job_location.edit', compact(
            'countries',
            'provinces',
            'jobLocation'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'province_id' => ['required'],
            'country_id' => ['required'],
            'image' => ['nullable'],
            'status' => ['nullable']
        ]);

        $data = [];
        $oldPath = JobLocation::where('id',$id)->select('image')->first();
        $imagePath = $this->uploadFile($request,'image',$oldPath?->image);
        if($imagePath) $data['image'] = $imagePath;
        $data['province_id'] = $request->province_id;
        $data['country_id'] = $request->country_id;
        $data['status'] = $request->status;

        JobLocation::updateOrCreate(
            ['id' => $id],
            $data
        );
        Notify::UpdateNotify();
        return to_route('admin.job-location.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            JobLocation::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
