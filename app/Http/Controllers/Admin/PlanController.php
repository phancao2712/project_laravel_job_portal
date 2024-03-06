<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanStoreRequest;
use App\Models\Plan;
use App\Services\Notify;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $plans = Plan::all();
        return view('admin.plan.index', compact(
            'plans'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanStoreRequest $request) : RedirectResponse
    {
        $model = new Plan();
        $model->lable = $request->lable;
        $model->price = $request->price;
        $model->job_limit = $request->job_limit;
        $model->highlight_job_limit = $request->highlight_job_limit;
        $model->featured_job_limit = $request->featured_job_limit;
        $model->profile_verified = $request->profile_verified;
        $model->recommended = $request->recommended;
        $model->frontend_show = $request->frontend_show;
        $model->save();
        Notify::CreateNotify();
        return to_route('admin.plans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
