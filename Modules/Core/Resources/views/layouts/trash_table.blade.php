{{-- <table class="trash_data_table table table-hover table-center mb-0" style="width: 99%;"> --}}
<table class="trash_data_table table table-bordered table-hover table-center mb-0" id="table">
    <thead>
        <tr>
            <th class="massActionWrapper" style="width: 30px;">
                <div class="btn-group">
                    <input type="checkbox" id="master_chk">
                    <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split p-0 px-1" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        @isset($include_restore_all_url)
                            <li>
                                <button class="dropdown-item" id="restore_all" data-url="{{ $include_restore_all_url }}">
                                    <i class="material-icons text-sm">restore</i>
                                    {{ __('core::core.form.restore_all') }}
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
        $('.trash_data_table').DataTable({
            @include('admin::layouts.includes.js.json_datatable')

            processing: true,
            responsive: false,
            serverSide: true,

            "targets": 'no-sort',
            "bSort": false,
            "order": [],

            ajax: "@isset($include_index_table_data_route){{ $include_index_table_data_route }}@endisset",
            columns: [
                {
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },

                @isset($include_table_rows)
                    @foreach ($include_table_rows as $key => $value)
                        {
                            data: "{{ $key }}",
                            name: "{{ $key }}",
                            orderable: false,
                            searchable: true
                        },
                    @endforeach
                @endisset
            ],
        });
    </script>
@endpush
