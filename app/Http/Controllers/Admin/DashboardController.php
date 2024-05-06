<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Candidate;
use App\Models\Job;
use App\Models\Order;
use App\Traits\Searchable;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    use Searchable;
    public function index():View {
        $amount = Order::where('payment_status', 'paid')->pluck('amount')->toArray();
        $totalEarning = calculateEarning($amount);
        $candidateCount = Candidate::count();
        $companyCount = Candidate::count();
        $totalJob = Job::count();
        $jobActive = Job::where('deadline', '>=', date('Y-m-d'))->where('status', 'active')->count();
        $jobPending = Job::where('deadline', '>=', date('Y-m-d'))->where('status', 'pending')->count();
        $jobExpired = Job::where('deadline', '>=', date('Y-m-d'))->count();
        $totalBlog = Blog::count();

        $query = Job::query()->where('status','pending');
        $this->search($query, ['title']);
        $jobs = $query->paginate(20);


        return view('admin.dashboard.index', compact(
            'candidateCount',
            'companyCount',
            'totalEarning',
            'totalJob',
            'jobActive',
            'jobExpired',
            'totalBlog',
            'jobPending',
            'jobs'
        ));
    }
}
