<script>
    $(document).ready(function() {
        $("body").on("click", "#master_chk", function() {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
                $(".sub_chk").css("opacity", "50%");
            } else {
                $(".sub_chk").prop('checked', false);
                $(".sub_chk").css("opacity", "30%");
            }
        });

        $("body").on("click", ".sub_chk", function() {
            if ($(this).is(':checked', true)) {
                $("#master_chk").prop('checked', true);
            }
        });

        $("body").on("click", "#restore_all", function() {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if (allVals.length <= 0) {
                swal({
                    title: "{{ __('core::core.atleast_one_row') }}",
                    type: "error",
                    confirmButtonText: "{{ __('core::core.form.ok-button') }}",
                });
            } else {
                var check = swal({
                    title: "{{ __('core::core.sure') }}",
                    text: "{{ __('core::core.restore_warning') }}",
                    type: "error",
                    showCancelButton: true,
                    dangerMode: true,
                    cancelButtonClass: '#DD6B55',
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: "{{ __('core::core.form.delete-button') }}",
                    cancelButtonText: "{{ __('core::core.form.cancel-button') }}",
                }, function(result) {
                    if (result) {
                        var join_selected_values = allVals.join(",");
                        var url = $('#restore_all').attr('data-url');
                        $.ajax({
                            url: url,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + join_selected_values,
                            success: function(result) {
                                    @include('admin::layouts.includes.js.json_response')

                                    $("#master_chk").prop('checked', false);
                                    $(".data_table").DataTable().ajax.reload();
                                    $(".trash_data_table").DataTable().ajax.reload();
                            },
                            error: function(result) {
                                // alert(data.responseText);
                                swal({
                                    title: result.responseText,
                                    type: "error",
                                });
                            }
                        });


                        $.each(allVals, function(index, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });

                    }
                });


            }

        });
    });
</script>
