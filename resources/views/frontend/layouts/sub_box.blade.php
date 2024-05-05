<section class="section-box subscription_box">
    <div class="container">
      <div class="box-newsletter">
        <div class="newsletter_textarea">
          <div class="row">
            <div class="col-lg-6">
              <h2 class="text-md-newsletter">Subscribe our newsletter</h2>
            </div>
            <div class="col-lg-6">
              <div class="box-form-newsletter">
                <form class="form-newsletter">
                    @csrf
                  <input class="input-newsletter" name="email" type="text" value="" placeholder="Enter your email here">
                  <button class="btn btn-default btn-subscribe font-heading">Subscribe</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@push('script')
    <script>
        $(document).ready(function () {
            $('.form-newsletter').on('submit', function (e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let button = $('.btn-subscribe')
                $.ajax({
                    type: "POST",
                    url: "{{ route('new-letter.store') }}",
                    data: formData,
                    beforeSend: function() {
                        button.text('Processing...');
                        button.prop('disabled', true);
                    },
                    success: function(response) {
                        button.text('Subscribe');
                        button.prop('disabled', false);
                        $('.form-newsletter').trigger('reset');
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        button.text('Subscribe');
                        button.prop('disabled', false);
                        let erorrs = xhr.responseJSON.errors;
                        $.each(erorrs, function(index, value) {
                            notyf.error(value[0])
                        });
                    }
                });
            })
        });
    </script>
@endpush
