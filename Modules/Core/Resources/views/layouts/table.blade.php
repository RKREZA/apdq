<table class="data_table table table-bordered table-hover table-center mb-0" id="table">
    <thead>
        <tr>
            @if (isset($include_trash_all_url) && $include_trash_all_url != null && isset($include_delete_all_permission) && Gate::check($include_delete_all_permission))
                <th class="massActionWrapper" style="width: 30px;">
                    <div class="btn-group">
                        <input type="checkbox" id="master_chk">
                        <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split p-0 px-1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            @isset($include_trash_all_url)
                                <li>
                                    <button class="dropdown-item" id="trash_all" data-url="{{ $include_trash_all_url }}">
                                        <i class="material-icons text-sm">close</i>
                                        {{ __('core::core.form.trash_all') }}
                                    </button>
                                </li>
                            @endisset
                            @isset($include_delete_all_url)
                                <li>
                                    <button class="dropdown-item" id="delete_all" data-url="{{ $include_delete_all_url }}">
                                        <i class="material-icons text-sm">delete</i>
                                        {{ __('core::core.form.delete_all') }}
                                    </button>
                                </li>
                            @endisset
                        </ul>
                    </div>
                </th>
            @endif

            @isset($include_table_rows)
                @foreach ($include_table_rows as $key => $value)
                    <th class="">{{ $value }}</th>
                @endforeach
            @endisset

        </tr>
    </thead>

    <tbody>

    </tbody>

</table>

@push('js')
    <script>
        $('.data_table').DataTable({
            @include('admin::layouts.includes.js.json_datatable')

            processing: true,
            responsive: false,
            serverSide: true,
            "targets": 'no-sort',
            "bSort": false,
            "order": [],

            ajax:{
                "url": "@isset($include_index_table_data_route){{ $include_index_table_data_route }}@endisset",
                "type": "GET",
                "data": {
                    @isset($filter_ajax_data)
                        @include('core::layouts.filter_ajax_data')
                    @endisset
                }
            },

            columns: [
                @if (isset($include_trash_all_url) && $include_trash_all_url != null && isset($include_delete_all_permission) && Gate::check($include_delete_all_permission))
                {
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                @endif

                @isset($include_table_rows)
                    @foreach ($include_table_rows as $key => $value)
                        {
                            data: "{{ $key }}",
                            name: "{{ $key }}",
                            orderable: true,
                            searchable: true
                        },
                    @endforeach
                @endisset
            ],

        });
    </script>
@endpush
