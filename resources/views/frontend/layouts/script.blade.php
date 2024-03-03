<script>
    // create notify
    var notyf = new Notyf();

    // create datepicker
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
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

</script>
