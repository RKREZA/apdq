<?php

namespace Modules\Cms\DataTables;

use Modules\Cms\Entities\Page;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Gate;
use Modules\Core\Helpers\CoreHelper;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\Cms\Entities\PageCategory;

class PagesDataTable extends DataTable
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

            ->addColumn('photo', function($row){
                if (count($row->files)>0) {
                    $photo = '<img src="/'.$row->files[0]->path.'" class="rounded-circle img-fluid img-thumbnail" style="width: 50px; height:50px">';
                }else{
                    $photo = '<img src="/assets/backend/img/no-image.png" class="rounded-circle img-fluid img-thumbnail" style="width: 50px; height:50px">';
                }
                return $photo;
            })

            ->addColumn('action', function($row){
                if (Gate::check('page-edit')) {
                    $edit = '<a href="'.route('admin.pages.edit', $row->id).'" class="btn btn-sm btn-success mb-0 px-2" title="'.__('core::core.form.edit-button').'" data-toggle="tooltip">
                                    <i class="material-icons text-sm">edit</i>
                            </a>';
                }else{
                    $edit = '';
                }

                if (Gate::check('page-delete')) {
                    $delete = '<button class="remove btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.pages.trash').'" title="'.__('core::core.form.trash-button').'" data-toggle="tooltip">
                                    <i class="material-icons text-sm">delete</i>
                                </button>';
                }else{
                    $delete = '';
                }

                $action = $edit.' '.$delete;
                return $action;
            })

            ->addColumn('title', function($row){
                $title = wordwrap($row->title, 100, "<br>\n", true);
                return mb_convert_encoding($title, 'UTF-8', 'UTF-8');
            })

            ->addColumn('description', function($row){
                $description = substr(strip_tags($row->description), 0, 50)."...";
                return mb_convert_encoding($description, 'UTF-8', 'UTF-8');
            })

            ->addColumn('category_id', function($row){
                $category = PageCategory::find($row->category_id);
                if (empty($category)) {
                    return 'NaN';
                }
                return $category->name;
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

            ->addColumn('thumbnail_url', function($row){

                $thumbnail = "<img=\"$row->thumbnail_url\">";

                return $thumbnail;
            })

            ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	        ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')

            ->setRowId('id')
            ->rawColumns(['title','photo','action','checkbox','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Page $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Page $model): QueryBuilder
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
                    ->setTableId('pages-table')
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
        return 'pages_' . date('YmdHis');
    }
}
