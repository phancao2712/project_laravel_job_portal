@extends('frontend.layouts.master')

@section('contents')
    <section class="section-box">
        <div class="archive-header pt-40">
            <div class="container">
                <div class="box-white">
                    <!-- <div class="max-width-single"><a class="btn btn-tag" href="#">Job Tips</a> -->
                    <h2 class="mb-30 mt-20">{{ $blog->title }}</h2>
                    <div class="post-meta text-muted d-flex mx-auto">
                        <div class="author d-flex mr-30"><span>{{ $blog->author->name }}</span></div>
                        <div class="date"><span class="font-xs color-text-paragraph-2 mr-20 d-inline-block"><img
                                    class="img-middle mr-5"
                                    src="{{ asset('frontend/assets/imgs/page/blog/calendar.svg') }}">{{ formatDate($blog->created_at) }}</span><span
                                class="font-xs color-text-paragraph-2 d-inline-block"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <div class="post-loop-grid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="single-body">
                        {{-- <div class="">
              <div class="font-lg mb-30">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ornare pellentesque sollicitudin.
                  Suspendisse potenti. Fusce ex risus, iaculis sit amet sapien nec, finibus malesuada mi. Proin at
                  turpis eget sapien
                  pulvinar luctus. Vestibulum bibendum pharetra lorem eu aliquam. In feugiat placerat risus, sed
                  rutrum neque mattis sit amet. Nullam vestibulum ante ac quam tempor, id venenatis velit eleifend.
                  Duis id iaculis risus,
                  quis ullamcorper augue. Nunc tristique venenatis ipsum at euismod. Pellentesque id arcu est.
                </p>
              </div>
            </div> --}}
                        <figure><img width="100%" height="400px" style="object-fit: cover"
                                src="{{ asset($blog->image) }}"></figure>
                        <div class="">
                            <div class="content-single">
                                {!! $blog->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-apply-jobs">
                <div class="row align-items-start">
                    <div class="col-md-7 social-share">
                        <h6 class="color-text-paragraph-2 d-inline-block d-baseline mr-10">Share this</h6><a
                            data-social="facebook" class="mr-5 d-inline-block d-middle" href="#"><img
                                alt="joblist"
                                src="{{ asset('frontend/assets/imgs/template/icons/share-fb.svg') }}"></a><a
                            class="mr-5 d-inline-block d-middle" href="#" data-social="twitter"><img
                                alt="joblist"
                                src="{{ asset('frontend/assets/imgs/template/icons/share-tw.svg') }}"></a><a
                            class="mr-5 d-inline-block d-middle" href="#" data-social="reddit"><img
                                alt="joblist"
                                src="{{ asset('frontend/assets/imgs/template/icons/share-red.svg') }}"></a><a
                            class="d-inline-block d-middle" href="#" data-social="linkedin"><img
                                alt="joblist"
                                src="{{ asset('frontend/assets/imgs/template/icons/share-linked.svg') }}"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
