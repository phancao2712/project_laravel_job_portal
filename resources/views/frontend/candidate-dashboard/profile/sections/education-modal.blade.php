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
                                <label for="level">Name Shool *</label>
                                <input type="text" name="level" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="">Year end*</label>
                                <input type="text" class="yearpicker" name="year" class="form-control" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="degree">Degree *</label>
                                <input type="text" name="degree" class="form-control" required="">
                            </div>
                            <div class="col-md-12">
                                <label for="note">Note</label>
                                <textarea name="note" id="" class="form-control"></textarea>
                            </div>

                            <div class="text-right mt-10">
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

    @push('script')
    <script>
        function fetchEdutcation() {
            $.ajax({
                method: "GET",
                url: "{{ route('candidate.education.index') }}",
                data: {},
                success: function (response) {
                    $('.education-tbody').html(response)
                }
            });
        }
        // save education
        $(document).ready(function() {
            var editId = '';
            var editMode = false;
            $("body").on('submit', '#educationForm', function(e) {
                e.preventDefault();
                const formdata = $(this).serialize();
                if (editMode) {
                    $.ajax({
                        method: 'PUT',
                        url: "{{ route('candidate.education.update', ':id') }}".replace(':id',
                            editId),
                        data: formdata,
                        beforeSend: function() {
                            showLoader();
                        },
                        success: function(response) {
                            fetchEdutcation()
                            $('#educationForm').trigger('reset');
                            $('#educationModal').modal('hide');
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
                        url: "{{ route('candidate.education.store') }}",
                        data: formdata,
                        beforeSend: function() {
                            showLoader()
                        },
                        success: function(response) {
                            fetchEdutcation()
                            $('#educationForm').trigger('reset');
                            $('#educationModal').modal('hide');

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

            $("body").on('click', '.edit-education', function(e) {
                e.preventDefault();
                let url = $(this).attr('href')
                console.log(url);
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

                            if (index === 'note') {
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
        $("body").on("click", '.delete-education', function(e) {
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
                            fetchEdutcation()
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
