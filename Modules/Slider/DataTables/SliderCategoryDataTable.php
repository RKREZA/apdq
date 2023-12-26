<?php

namespace Modules\Slider\DataTables;

use Modules\Slider\Entities\Slider;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Gate;
use Modules\Core\Helpers\CoreHelper;
use Modules\Slider\Entities\SliderCategory;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class SliderCategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $data = CoreHelper::filter_data(request(), $query);

        return (new EloquentDataTable($data))
            ->addIndexColumn()
            ->addColumn('checkbox', function($row){
                $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                return $checkbox;
            })
            ->addColumn('action', function($row){
                if (Gate::check('slidercategory-edit')) {
                    $edit = '<a href="'.route('admin.slidercategories.edit', $row->id).'" class="btn btn-sm btn-success mb-0 px-2" title="'.__('core::core.form.edit-button').'" data-toggle="tooltip">
                                    <i class="material-icons text-sm">edit</i>
                            </a>';
                }else{
                    $edit = '';
                }

                if (Gate::check('slidercategory-delete')) {
                    $delete = '<button class="remove btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.slidercategories.trash').'" title="'.__('core::core.form.trash-button').'" data-toggle="tooltip">
                                    <i class="material-icons text-sm">delete</i>
                                </button>';
                }else{
                    $delete = '';
                }

                $action = $edit.' '.$delete;
                return $action;
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

            ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	        ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')

            ->setRowId('id')
            ->rawColumns(['action','checkbox','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\SliderCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SliderCategory $model): QueryBuilder
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
                    ->setTableId('sliders-table')
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
        return 'slidercategories_' . date('YmdHis');
    }
}
