<section class="section-box futured_jobs mt-20">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Featured Jobs</h2>
            <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Check out our latest featured job's</p>
            <div class="list-tabs mt-40">
                <ul class="nav nav-tabs" role="tablist">
                    @foreach ($featuredCategory as $category)
                        <li><a class="{{ $loop->index === 0 ? 'active' : '' }}" id="nav-tab-job-{{ $category->id }}"
                                href="#tab-job-{{ $category->id }}" data-bs-toggle="tab" role="tab"
                                aria-controls="tab-job-{{ $category->id }}"
                                aria-selected="true">{{ $category->name }}</a></li>
                    @endforeach

                </ul>
            </div>
        </div>
        <div class="mt-70">
            <div class="tab-content" id="myTabContent-1">
                @foreach ($featuredCategory as $category)
                    <div class="tab-pane fade {{ $loop->index === 0 ? 'show active' : '' }}"
                        id="tab-job-{{ $category->id }}" role="tabpanel" aria-labelledby="tab-job-{{ $category->id }}">
                        <div class="row">

                            @php
                                $featuredJob = $category
                                    ->jobs()
                                    ->where(['status' => 'active'])
                                    ->where('featured', 1)
                                    ->where('deadline', '>=', date('Y-m-d'))
                                    ->take(8)
                                    ->get();
                            @endphp
                            @foreach ($featuredJob as $job)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="card-grid-2 hover-up">
                                        <div class="card-grid-2-image-left"><span class="flash"></span>
                                            <div class="image-box"><img src="{{ asset($job->company?->logo) }}"
                                                    alt="joblist">
                                            </div>
                                        </div>
                                        <div class="card-block-info">
                                            <h6><a href="job-details.html">{{ Str::limit($job->title, 25, '...') }}</a>
                                            </h6>
                                            <div class="mt-5"><span
                                                    class="card-briefcase">{{ $job->salaryType->name }}</span><span
                                                    class="card-time">{{ $job->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="font-sm color-text-paragraph mt-15">{!! $job->description !!}</p>
                                            <div class="pl-15 mb-15 mt-30">
                                                @foreach ($job->skills as $skill)
                                                    @if ($loop->index <= 6)
                                                        <a class=" mr-5"
                                                            href="javascript:;">{{ $skill->skill->name }}</a>
                                                    @elseif($loop->index >= 7)
                                                        <a class=" mr-5 job-skill" href="javascript:;">More ...</a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <span class="card-text-price" style="font-size: 15px">
                                            @if ($job->salary_mode == 'range')
                                                {{ $job?->min_salary }} - {{ $job?->max_salary }}
                                                {{ config('settings.site_default_currency') }} /
                                                {{ $job->salaryType->name }}
                                            @else
                                                {{ $job?->custom_salary !== null ? $job?->custom_salary . config('settings.site_default_currency') . ' / ' . $job->salaryType->name : 'Compativities' }}
                                            @endif
                                        </span>
                                        <a href="{{ route('job.show', $job->slug) }}" class="btn btn-apply-now">
                                            View job</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
