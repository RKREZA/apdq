<script type="text/javascript">
    function changeStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 'Active' : 'Inactive';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: include_change_status_route,
            type: 'get',
            data: {
                _token: _token,
                id: id,
                status: status
            },
            success: function(result) {
                @include('admin::layouts.includes.js.json_response')
            },
        });
    }
</script>
