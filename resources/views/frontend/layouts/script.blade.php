<script>
    // create notify
    var notyf = new Notyf();

    // create datepicker
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    });

    $(".yearpicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });

    // create ckeditor
    ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
        console.error(error);
    });

    // setup reload
    function hideLoader() {
        $('.preloader_demo').addClass('d-none');
    }

    function showLoader() {
        $('.preloader_demo').removeClass('d-none');
    }

    $(document).ready(function () {
        $('.bookmark').on('click', function(e){
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                    type: "GET",
                    url: "{{ route('job.bookmark', ':id') }}".replace(':id',id),
                    data: {
                    },
                    beforeSend: function() {

                    },
                    success: function (response) {

                        $('.bookmark').each(function() {
                            let elementId = $(this).data('id');
                            if(elementId == response.id){
                                $(this).find('i').addClass('fas fa-bookmark');
                            }
                        })

                        notyf.success(response.message);
                    },
                    error: function (xhr, status, error) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function (index, value) {
                            notyf.error(value[index]);
                        });
                    }
                });
        })
    });
</script>
