@push('script')
    <script>
        $(document).ready(function(){
            $('.country').on('change', function(){
                let id = $(this).val();
                $.ajax({
                    method: "GET",
                    url: '{{ route("get-province", ":id") }}'.replace(":id", id),
                    data: "",
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        let html = '<option value="">Select Province</option>';

                        $.each(response, function (key, value) {
                            html += `<option value="${value.id}">${value.name}</option>`
                        });

                        $('.province').html(html);
                    },
                    error: function (xhr, resonse, error){

                    }
                });
            })

            $('.province').on('change', function(){
                let id = $(this).val();
                $.ajax({
                    method: "GET",
                    url: '{{ route("get-district", ":id") }}'.replace(":id", id),
                    data: "",
                    dataType: "json",
                    success: function (response) {
                        let html = '<option value="">Select District</option>';

                        $.each(response, function (key, value) {
                            html += `<option value="${value.id}">${value.name}</option>`
                        });

                        $('.district').html(html);
                    },
                    error: function (xhr, resonse, error){

                    }
                });
            })
        })
    </script>
@endpush
