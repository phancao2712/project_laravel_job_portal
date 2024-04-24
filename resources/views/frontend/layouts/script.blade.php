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
</script>
