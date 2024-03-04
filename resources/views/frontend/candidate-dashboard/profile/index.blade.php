@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Profile</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ route('home') }}">Home</a></li>
                            <li>Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-120">
        <div class="container">
            <div class="row">
                @include('frontend.candidate-dashboard.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Basic</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-experience" type="button" role="tab"
                                aria-controls="pills-experience" aria-selected="false">Experience & Education</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Account Setting</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        {{-- Basic --}}
                        @include('frontend.candidate-dashboard.profile.sections.basic')

                        {{-- Profile --}}
                        @include('frontend.candidate-dashboard.profile.sections.profile')

                        {{-- Experience --}}
                        @include('frontend.candidate-dashboard.profile.sections.experience')
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="experienceForm">
                        @csrf
                        <div class="row form-controler">
                            <div class="col-md-12">
                                <label for="company">Company *</label>
                                <input type="text" name="company" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="company">Department *</label>
                                <input type="text" name="department" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="designation">Designation *</label>
                                <input type="text" name="designation" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="company">Date start *</label>
                                <input type="text" class="datepicker" name="start" class="form-control"
                                    required="">
                            </div>
                            <div class="col-md-6">
                                <label for="company">Date end *</label>
                                <input type="text" class="datepicker" name="end" class="form-control"
                                    required="">
                            </div>
                            <div class="col-md-12 mt-10 mb-10">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="current_working">
                                <label class="form-check-label" for="remember">I am currently working</label>
                            </div>
                            <div class="col-md-12">
                                <label for="company">Responsibility</label>
                                <textarea name="responsibilites" id="" class="form-control"></textarea>
                            </div>

                            <div class="text-right">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create Experience</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="educationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="educationForm">
                        @csrf
                        <div class="row form-controler">
                            <div class="col-md-12">
                                <label for="company">Company *</label>
                                <input type="text" name="company" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="company">Department *</label>
                                <input type="text" name="department" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="designation">Designation *</label>
                                <input type="text" name="designation" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="company">Date start *</label>
                                <input type="text" class="datepicker" name="start" class="form-control"
                                    required="">
                            </div>
                            <div class="col-md-6">
                                <label for="company">Date end *</label>
                                <input type="text" class="datepicker" name="end" class="form-control"
                                    required="">
                            </div>
                            <div class="col-md-12 mt-10 mb-10">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="current_working">
                                <label class="form-check-label" for="remember">I am currently working</label>
                            </div>
                            <div class="col-md-12">
                                <label for="company">Responsibility</label>
                                <textarea name="responsibilites" id="" class="form-control"></textarea>
                            </div>

                            <div class="text-right">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Education</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        // reload data table
        function fetchExperience() {
            $.ajax({
                method: 'GET',
                url: "{{ route('candidate.experience.index') }}",
                data: {},
                success: function(response) {
                    $('.experience-tbody').html(response)
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
        // save experience
        $(document).ready(function() {
            var editId = '';
            var editMode = false;
            $("body").on('submit', '#experienceForm', function(e) {
                e.preventDefault();
                const formdata = $(this).serialize();
                if (editMode) {
                    $.ajax({
                        method: 'PUT',
                        url: "{{ route('candidate.experience.update', ':id') }}".replace(':id',
                            editId),
                        data: formdata,
                        beforeSend: function() {
                            showLoader();
                        },
                        success: function(response) {
                            fetchExperience()
                            $('#experienceForm').trigger('reset');
                            $('#staticBackdrop').modal('hide');
                            editId = '';
                            editMode = false;
                            hideLoader();
                            notyf.success(response.message);
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            hideLoader();
                        }
                    });
                } else {
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('candidate.experience.store') }}",
                        data: formdata,
                        beforeSend: function() {
                            showLoader()
                        },
                        success: function(response) {
                            fetchExperience()
                            $('#experienceForm').trigger('reset');
                            $('#staticBackdrop').modal('hide');

                            hideLoader();
                            notyf.success(response.message);
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            hideLoader();
                        }
                    });
                }
            })

            $("body").on('click', '.editExperience', function(e) {
                e.preventDefault();
                let url = $(this).attr('href')

                $.ajax({
                    method: 'GET',
                    url: url,
                    data: {},
                    beforeSend : function () {
                        showLoader();
                    },
                    success: function(response) {
                        editId = response.id;
                        editMode = true;
                        $.each(response, function(index, value) {
                            $(`input[name="${index}"]:text`).val(value);

                            if (index === 'current_working' && value == 1) {
                                $(`input[name="${index}"]:checkbox`).prop('checked',
                                    true)
                            }

                            if (index === 'responsibilites') {
                                $(`textarea[name="${index}"]`).val(value);
                            }
                        });
                        hideLoader();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        hideLoader();
                    }
                });
            })
        })

        // delete experience
        $("body").on("click", '.delete-experience', function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $(this).attr("href");
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        method: "DELETE",
                        url: url,
                        data: {
                            _token: csrfToken
                        },
                        beforeSend: function() {
                            showLoader()
                        },
                        success: function(response) {
                            fetchExperience()
                            hideLoader();
                            notyf.success(response.message);
                        },
                        error: function(status, error, xhr) {
                            console.log(error);
                            hideLoader();
                        },
                    });
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });
        });
    </script>
@endpush
