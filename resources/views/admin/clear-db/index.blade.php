@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Clear Database</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Clear Database</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning alert-has-icon">
                            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Danger</div>
                                If you fire this action it will wipe your entire databse.
                            </div>
                            <form action="" class="mt-2 clear_db" >
                                @csrf
                                <button class="btn btn-danger submit_button" type="submit">Clear Database</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $(".clear_db").on("submit", function (e) {
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: "DELETE",
                    url: "{{ route('admin.clear-database.clearDatabase') }}",
                    data: {
                        _token: csrfToken
                    },
                    success: function (response) {
                        swal(xhr.responseJSON.message, {
                            icon: "success",
                        });
                    },
                    error: function (xhr,status ,error) {
                        swal(xhr.responseJSON.message, {
                            icon: "error",
                        });
                    },
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    });
        });
    </script>
@endpush

