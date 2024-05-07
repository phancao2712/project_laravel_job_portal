/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */
$(document).ready(function (){
    "use strict";

    // create ckeditor
    ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
        console.error(error);
    });

    $(".delete-btn").on("click", function (e) {
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                let url = $(this).attr("href");
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: "DELETE",
                    url: url,
                    data: {
                        _token: csrfToken
                    },
                    success: function (response) {
                        window.location.reload();
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
})
