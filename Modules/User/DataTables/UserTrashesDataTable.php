<?php

namespace Modules\User\DataTables;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Modules\Core\Helpers\CoreHelper;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserTrashesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        // $data = CoreHelper::filter_data_for_admin(request(), $query);
        $data = CoreHelper::filter_data(request(), $query);

        return (new EloquentDataTable($data))
            ->addIndexColumn()
            ->addColumn('checkbox', function($row){
                $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                return $checkbox;
            })
            ->addColumn('action', function($row){
                if (Gate::check('user-delete')) {
                    $restore = '<button class="restore btn btn-sm btn-secondary mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.users.restore').'" title="'.__('core::core.form.restore-button').'" data-toggle="tooltip">
                                    <i class="material-icons text-sm">restore</i>
                                </button>';
                }else{
                    $restore = '';
                }

                if (Gate::check('user-delete')) {
                    $delete = '<button class="force_destroy btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.users.force_destroy').'" title="'.__('core::core.form.delete-button').'" data-toggle="tooltip">
                                    <i class="material-icons text-sm">delete_forever</i>
                                </button>';
                }else{
                    $delete = '';
                }

                $action = $restore.' '.$delete;
                return $action;
            })
            ->setRowId('id')
            ->addColumn('role', function ($row) {
                $roles = $row->getRoleNames();
                foreach($roles as $role){
                    if(count($roles) > 1){
                        $all_role = $role.',';
                    }else{
                        $all_role = $role;
                    }
                }
                return $all_role;
            })
            ->addColumn('status', function($row){
                if ($row->status == "Active") {
                    $current_status = 'Checked';
                }else{
                    $current_status = '';
                }
                $status = "<input type='checkbox' id='status_$row->id' id='user-$row->id' class='check' onclick='changeStatus(event.target, $row->id);' " .$current_status. ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>";
                return $status;
            })
            ->addColumn('photo', function($row){
                if (count($row->files)>0) {
                    $photo = '<img src="/'.$row->files[0]->path.'" class="rounded-circle img-fluid img-thumbnail" style="width: 50px; height:50px">';
                }else{
                    $photo = '<img src="/assets/backend/img/no-image.webp" class="rounded-circle img-fluid img-thumbnail" style="width: 50px; height:50px">';
                }
                return $photo;
            })
            ->rawColumns(['action','photo','checkbox','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ])

                    ->parameters([
                            'dom'          => 'Bfrtip',
                            'buttons'      => ['export', 'print', 'reset', 'reload'],
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
