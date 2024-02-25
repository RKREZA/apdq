<?php

namespace Modules\Live\DataTables;

use Modules\Live\Entities\Live;
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

class LivesDataTable extends DataTable
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
                if (Gate::check('live-edit')) {
                    $edit = '<a href="'.route('admin.lives.edit', $row->id).'" class="btn btn-sm btn-success mb-0 px-2" title="'.__('core::core.form.edit-button').'" data-toggle="tooltip">
                                    <i class="material-icons text-sm">edit</i>
                            </a>';
                }else{
                    $edit = '';
                }

                if (Gate::check('live-delete')) {
                    $delete = '<button class="remove btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.lives.trash').'" title="'.__('core::core.form.trash-button').'" data-toggle="tooltip">
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
                $title.='&nbsp;';
                if($row->content_type == 'free'){
                    $title.='<span class="badge badge-success">'.$row->content_type.'</span>';
                }else{
                    $title.='<span class="badge badge-warning">'.$row->content_type.'</span>';
                }

                return mb_convert_encoding($title, 'UTF-8', 'UTF-8');
            })

            ->addColumn('description', function($row){
                $description = substr(strip_tags($row->description), 0, 50)."...";
                return mb_convert_encoding($description, 'UTF-8', 'UTF-8');
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

            ->addColumn('archive', function($row){

                if ($row->archive == "Active") {
                    $current_archive = 'Checked';
                }else{
                    $current_archive = '';
                }

                $archive = "<input type='checkbox' id='archive_$row->id' id='user-$row->id' class='check' onclick='changeArchive(event.target, $row->id);' " .$current_archive. ">
                        <label for='archive_$row->id' class='checktoggle'>checkbox</label>";

                return $archive;
            })

            ->addColumn('thumbnail_url', function ($row) {
                if (!empty($row->thumbnail_url)) {
                    // Check if the URL is already absolute
                    $isAbsoluteUrl = filter_var($row->thumbnail_url, FILTER_VALIDATE_URL) !== false;

                    $thumbnail_url = '<img src="' . ($isAbsoluteUrl ? $row->thumbnail_url : '/' . $row->thumbnail_url) . '" class="img-fluid img-thumbnail" style="width: 50px; height:50px">';
                } else {
                    $thumbnail_url = '<img src="/assets/backend/img/no-thumbnail.webp" class="rounded-circle img-fluid img-thumbnail" style="width: 50px; height:50px">';
                }

                return $thumbnail_url;
            })


            ->addColumn('created_at', function ($row) {

                if($row->publish_type == 'publish'){
                    $data = '<span class="badge badge-success">'.$row->publish_type.'</span>';
                }else{
                    $data = '<span class="badge badge-warning">'.$row->publish_type.'</span>';
                }
                $data.="<br>";
                $data.= date("jS M Y", strtotime($row->created_at));
                $data.="<br>";
                $data.= date("H:i:A", strtotime($row->created_at));
                return $data;
            })

	        ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')

            ->setRowId('id')
            ->rawColumns(['title','thumbnail_url','action','checkbox','status','archive','created_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Live $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Live $model): QueryBuilder
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
                    ->setTableId('lives-table')
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
        return 'lives_' . date('YmdHis');
    }
}
