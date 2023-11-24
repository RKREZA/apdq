<script type="text/javascript">

    function changeDefault(_this, id) {
        if(typeof include_change_default_route !== 'undefined'){
            var default_status = $(_this).prop('checked') == true ? 'Active' : 'Inactive';
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: include_change_default_route,
                type: 'get',
                data: {
                    _token: _token,
                    id: id,
                    default_status: default_status
                },
                success: function(result) {
                    @include('admin::layouts.includes.js.json_response')

                    setTimeout(function(){// wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 2000);
                }
            });
        }
    }


</script>
