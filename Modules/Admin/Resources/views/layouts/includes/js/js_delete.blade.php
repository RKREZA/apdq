
{{-- Delete Data From Database --}}
<script>
    $("body").on("click", ".remove", function() {
        var current_object = $(this);
        swal({
            title: "{{ __('core::core.sure') }}",
            text: "{{ __('core::core.delete_warning') }}",
            type: "error",
            showCancelButton: true,
            dangerMode: true,
            cancelButtonClass: '#DD6B55',
            confirmButtonColor: '#dc3545',
            confirmButtonText: "{{ __('core::core.form.delete-button') }}",
            cancelButtonText: "{{ __('core::core.form.cancel-button') }}",
        }, function(result) {
            if (result) {
                var action = current_object.attr('data-action');
                let _token = $('meta[name="csrf-token"]').attr('content');
                var id = current_object.attr('data-id');

                $.ajax({
                    url: action,
                    type: 'DELETE',
                    data: {
                        _token: _token,
                        id: id,
                    },
                    success: function(result) {
                        @include('admin::layouts.includes.js.json_response')
                        if(result.reload == 'true'){
                            location.reload();
                        }
                        $(".data_table").DataTable().ajax.reload();
                        $(".trash_data_table").DataTable().ajax.reload();
                    },
                });
            }
        });
    });
</script>

{{-- Force Delete Data From Database --}}
<script>
    $("body").on("click", ".force_destroy", function() {
        var current_object = $(this);
        swal({
            title: "{{ __('core::core.sure') }}",
            text: "{{ __('core::core.force_delete_warning') }}",
            type: "error",
            showCancelButton: true,
            dangerMode: true,
            cancelButtonClass: '#DD6B55',
            confirmButtonColor: '#dc3545',
            confirmButtonText: "{{ __('core::core.form.delete-button') }}",
            cancelButtonText: "{{ __('core::core.form.cancel-button') }}",
        }, function(result) {
            if (result) {
                var action = current_object.attr('data-action');
                let _token = $('meta[name="csrf-token"]').attr('content');
                var id = current_object.attr('data-id');

                $.ajax({
                    url: action,
                    type: 'DELETE',
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

{{-- Delete Uploaded File --}}
<script>
    $("body").on("click", "#delete_file", function() {
        var current_object = $(this);
        swal({
            title: "{{ __('core::core.sure') }}",
            text: "{{ __('core::core.delete_warning') }}",
            type: "error",
            showCancelButton: true,
            dangerMode: true,
            cancelButtonClass: '#DD6B55',
            confirmButtonColor: '#dc3545',
            confirmButtonText: "{{ __('core::core.form.delete-button') }}",
            cancelButtonText: "{{ __('core::core.form.cancel-button') }}",
        }, function(result) {
            if (result) {
                var id = current_object.attr('data-id');

                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route("admin.files.destroy") }}',
                    data: {
                        id: id,
                    },
                    success: function(result) {
                        @include('admin::layouts.includes.js.json_response')
                        $(current_object).closest("tr").remove();
                        txt = $('#files').val().replace(id+',', '');
                        txt = $('#files').val().replace(','+id, '');
                        txt = $('#files').val().replace(id, '');
                        $('#files').val(txt);
                    },
                });

            }
        });
    });
</script>
