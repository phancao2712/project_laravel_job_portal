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
                            <label for="level">Department *</label>
                            <input type="text" name="department" class="form-control" required="">
                        </div>
                        <div class="col-md-6">
                            <label for="designation">Designation *</label>
                            <input type="text" name="designation" class="form-control" required="">
                        </div>
                        <div class="col-md-6">
                            <label for="company">Date start *</label>
                            <input type="text" class="datepicker" name="start" class="form-control" required="">
                        </div>
                        <div class="col-md-6">
                            <label for="company">Date end *</label>
                            <input type="text" class="datepicker" name="end" class="form-control" required="">
                        </div>
                        <div class="col-md-12 mt-10 mb-10">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="current_working">
                            <label class="form-check-label" for="remember">I am currently working</label>
                        </div>
                        <div class="col-md-12">
                            <label for="company">Responsibility</label>
                            <textarea name="responsibilites" id="" maxlength="500" cols="100" class="form-control"></textarea>
                        </div>

                        <div class="text-right mt-20">
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
                    beforeSend: function() {
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
