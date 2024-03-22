@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Port</h1>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-12">
            <form action="{{ route('admin.jobs.store') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">

                        <div class="card-header">
                            <h4>Job Detail</h4>
                            <div class="card-header-form">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-12 form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title"
                                        class="form-control {{ hasError($errors, 'title') }}" value="{{ old('title') }}">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Company <span class="text-danger">*</span></label>
                                    <select name="company_id" id=""
                                        class="form-control select2 {{ hasError($errors, 'company_id') }}">
                                        <option value="">Select company</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <select name="job_category_id" id=""
                                        class="form-control select2 {{ hasError($errors, 'job_category_id') }}">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('job_category_id')" class="mt-2" />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Total Vacancies <span class="text-danger">*</span></label>
                                    <input type="text" name="vacancies"
                                        class="form-control {{ hasError($errors, 'vacancies') }}"
                                        value="{{ old('vacancies') }}">
                                    <x-input-error :messages="$errors->get('vacancies')" class="mt-2" />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Deadline</label>
                                    <input type="text" name="deadline"
                                        class="form-control datepicker  {{ hasError($errors, 'deadline') }}"
                                        value="{{ old('deadline') }}">
                                    <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h4>Location</h4>
                            <div class="card-header-form">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-4 form-group">
                                    <label>Country</label>
                                    <select name="country" id=""
                                        class="form-control select2 country {{ hasError($errors, 'country') }}">
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Province</label>
                                    <select name="province" id=""
                                        class="form-control select2 province {{ hasError($errors, 'province') }}">

                                    </select>
                                    <x-input-error :messages="$errors->get('province')" class="mt-2" />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>District</label>
                                    <select name="district" id=""
                                        class="form-control select2 district {{ hasError($errors, 'district') }}">
                                    </select>
                                    <x-input-error :messages="$errors->get('district')" class="mt-2" />
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <input type="text" name="address"
                                        class="form-control {{ hasError($errors, 'address') }}"
                                        value="{{ old('address') }}">
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h4>Salary Detail</h4>
                            <div class="card-header-form">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-2 form-group">
                                    <input type="radio" name="salary_mode"
                                        class="from-control {{ hasError($errors, 'salary_mode') }}"
                                        value="range" onclick="changeSalaryMode('salary_range')"
                                        checked>
                                    <label>Salary Range</label>
                                    <x-input-error :messages="$errors->get('salary_mode')" class="mt-2" />
                                </div>
                                <div class="col-2 form-group">
                                    <input type="radio" name="salary_mode"
                                        class="from-control {{ hasError($errors, 'salary_mode') }}"
                                        value="custom" onclick="changeSalaryMode('salary_custom')">

                                    <label>Custom Range</label>
                                    <x-input-error :messages="$errors->get('salary_mode')" class="mt-2" />
                                </div>
                                <div class="col-sm-12 salary_range">
                                    <div class="row ">
                                        <div class="col-sm-6 form-group">
                                            <label>Minimum Salary <span class="text-danger">*</span></label>
                                            <input type="text" name="min_salary"
                                                class="form-control {{ hasError($errors, 'min_salary') }}"
                                                value="{{ old('min_salary') }}">
                                            <x-input-error :messages="$errors->get('min_salary')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label>Maximum Salary <span class="text-danger">*</span></label>
                                            <input type="text" name="max_salary"
                                                class="form-control {{ hasError($errors, 'max_salary') }}"
                                                value="{{ old('max_salary') }}">
                                            <x-input-error :messages="$errors->get('max_salary')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 form-group salary_custom d-none">
                                    <label>Salary Custom <span class="text-danger">*</span></label>
                                    <input type="text" name="custom_salary"
                                        class="form-control {{ hasError($errors, 'custom_salary') }}"
                                        value="{{ old('custom_salary') }}">
                                    <x-input-error :messages="$errors->get('custom_salary')" class="mt-2" />
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label>Salary Type <span class="text-danger">*</span></label>
                                    <select name="salary_type" id=""
                                        class="form-control select2 {{ hasError($errors, 'salary_type') }}">
                                        <option value="">Select Salary Type</option>
                                        @foreach ($salary_types as $salary_type)
                                            <option value="{{ $salary_type->id }}">{{ $salary_type->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('salary_type')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Attribute</h4>
                        <div class="card-header-form">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Experience <span class="text-danger">*</span></label>
                                <select name="job_experience_id" id=""
                                    class="form-control select2 {{ hasError($errors, 'job_experience_id') }}">
                                    <option value="">Select Experience</option>
                                    @foreach ($experiences as $exp)
                                    <option value="{{ $exp->id }}">{{ $exp->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('job_experience_id')" class="mt-2" />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Role <span class="text-danger">*</span></label>
                                <select name="job_role_id" id=""
                                    class="form-control select2 {{ hasError($errors, 'job_role_id') }}">
                                    <option value="">Select Job Role</option>
                                    @foreach ($job_roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('job_role_id')" class="mt-2" />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Education <span class="text-danger">*</span></label>
                                <select name="education_id" id=""
                                    class="form-control select2 {{ hasError($errors, 'education_id') }}">
                                    <option value="">Select Education <span class="text-danger">*</span></option>
                                    @foreach ($educations as $education)
                                    <option value="{{ $education->id }}">{{ $education->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('education_id')" class="mt-2" />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Type <span class="text-danger">*</span></label>
                                <select name="job_type_id" id=""
                                    class="form-control select2 {{ hasError($errors, 'job_type_id') }}">
                                    <option value="">Select Job Type <span class="text-danger">*</span></option>
                                    @foreach ($job_types as $job_type)
                                    <option value="{{ $job_type->id }}">{{ $job_type->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('job_type_id')" class="mt-2" />
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Tags <span class="text-danger">*</span></label>
                                <select name="tags[]" id="" multiple
                                    class="form-control select2 {{ hasError($errors, 'tags') }}">
                                    @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Benefits <span class="text-danger">*</span></label>
                                <input type="text" name="benefits"
                                    class="form-control inputtags {{ hasError($errors, 'benefits') }}"
                                    value="{{ old('benefits') }}">
                                <x-input-error :messages="$errors->get('benefits')" class="mt-2" />
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Skills <span class="text-danger">*</span></label>
                                <select name="skills[]" id="" multiple
                                    class="form-control select2 {{ hasError($errors, 'skills') }}">
                                    <option value="">Select Skill</option>
                                    @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Application Options</h4>
                        <div class="card-header-form">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Receive Application <span class="text-danger">*</span></label>
                                @php
                                    $receive_app = [
                                        'app' => 'On Our Platform',
                                        'email' => 'On your email address',
                                        'custom_url' => 'On a custom link',
                                    ];

                                @endphp
                                <select name="receive_application" id=""
                                    class="form-control {{ hasError($errors, 'receive_application') }}">
                                    <option value="">Select Application</option>
                                    @foreach ($receive_app as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach

                                </select>
                                <x-input-error :messages="$errors->get('receive_application')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h4>Promote</h4>
                            <div class="card-header-form">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-2 form-group">
                                    <input type="checkbox" name="featured"
                                        class="from-control {{ hasError($errors, 'featured') }}"
                                        value="1">
                                    <label>Featured</label>
                                    <x-input-error :messages="$errors->get('featured')" class="mt-2" />
                                </div>
                                <div class="col-2 form-group">
                                    <input type="checkbox" name="highlight"
                                        class="from-control {{ hasError($errors, 'highlight') }}"
                                        value="1">
                                    <label>Highlight</label>
                                    <x-input-error :messages="$errors->get('highlight')" class="mt-2" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h4>Descriptions</h4>
                            <div class="card-header-form">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-12 form-group">
                                    <label>Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="editor" cols="30" rows="10"></textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(".inputtags").tagsinput('items');

        function changeSalaryMode(mode) {
            if (mode == 'salary_range') {
                $('.salary_range').removeClass('d-none')
                $('.salary_custom').addClass('d-none')
            } else if (mode == 'salary_custom') {
                $('.salary_custom').removeClass('d-none')
                $('.salary_range').addClass('d-none')
            }
        }
    </script>
@endpush

@include('admin.layouts.get-location')
