
{{-- Restore Data To Database --}}
<script>
    $("body").on("click", ".restore", function() {
        var current_object = $(this);
        swal({
            title: "{{ __('core::core.sure') }}",
            text: "",
            type: "warning",
            showCancelButton: true,
            dangerMode: true,
            cancelButtonClass: '#DD6B55',
            confirmButtonColor: '#dc3545',
            confirmButtonText: "{{ __('core::core.form.restore-button') }}",
            cancelButtonText: "{{ __('core::core.form.cancel-button') }}",
        }, function(result) {
            if (result) {
                var action = current_object.attr('data-action');
                let _token = $('meta[name="csrf-token"]').attr('content');
                var id = current_object.attr('data-id');

                $.ajax({
                    url: action,
                    type: 'post',
                    data: {
                        _token: _token,
                        id: id,
                    },
                    success: function(result) {
                        @include('admin::layouts.includes.js.json_response')

                        $(".data_table").DataTable().ajax.reload();
                        $(".trash_data_table").DataTable().ajax.reload();
                    },
                });
            }
        });
    });
</script>
