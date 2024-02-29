@push('script')
    <script>
        $(document).ready(function(){
            $('.country').on('change', function(){
                let id = $(this).val();
                $.ajax({
                    method: "GET",
                    url: '{{ route("admin.location.get-province", ":id") }}'.replace(":id", id),
                    data: "",
                    dataType: "json",
                    success: function (response) {
                        let html = '<option value="">Select Provinces</option>';

                        $.each(response, function (key, value) {
                            html += `<option value="${value.id}">${value.name}</option>`
                        });

                        $('.province').html(html);
                    },
                    error: function (xhr, resonse, error){

                    }
                });
            })
        })
    </script>
@endpush

