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
    function __construct(){
        $this->middleware(['permission: price plan']);
    }
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
        $model->label = $request->label;
        $model->price = $request->price;
        $model->job_limit = $request->job_limit;
        $model->highlight_job_limit = $request->highlight_job_limit;
        $model->featured_job_limit = $request->featured_job_limit;
        $model->profile_verified = $request->profile_verified;
        $model->recommended = $request->recommended;
        $model->frontend_show = $request->frontend_show;
        $model->show_at_home = $request->show_at_home;
        $model->save();
        Notify::CreateNotify();
        return to_route('admin.plans.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $plan = Plan::findOrFail($id);
        return view('admin.plan.edit', compact(
            'plan'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Plan::findOrFail($id);

        $model->label = $request->label;
        $model->price = $request->price;
        $model->job_limit = $request->job_limit;
        $model->highlight_job_limit = $request->highlight_job_limit;
        $model->featured_job_limit = $request->featured_job_limit;
        $model->profile_verified = $request->profile_verified;
        $model->recommended = $request->recommended;
        $model->frontend_show = $request->frontend_show;
        $model->show_at_home = $request->show_at_home;
        $model->save();
        Notify::UpdateNotify();
        return to_route('admin.plans.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Plan::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
