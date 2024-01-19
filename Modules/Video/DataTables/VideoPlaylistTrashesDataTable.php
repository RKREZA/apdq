<?php

namespace Modules\Video\DataTables;

use Modules\Video\Entities\Video;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Modules\Core\Helpers\CoreHelper;
use Modules\Video\Entities\VideoPlaylist;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VideoPlaylistTrashesDataTable extends DataTable
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

        return (new EloquentDataTable($data->onlyTrashed()))
            ->addIndexColumn()
            ->addColumn('checkbox', function($row){
                $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                return $checkbox;
            })
            ->addColumn('action', function($row){
                if (Gate::check('videoplaylist-delete')) {
                    $restore = '<button class="restore btn btn-sm btn-secondary mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.videoplaylists.restore').'" title="'.__('core::core.form.restore-button').'" data-toggle="tooltip">
                                    <i class="material-icons text-sm">restore</i>
                                </button>';
                }else{
                    $restore = '';
                }

                if (Gate::check('videoplaylist-delete')) {
                    $delete = '<button class="force_destroy btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.videoplaylists.force_destroy').'" title="'.__('core::core.form.delete-button').'" data-toggle="tooltip">
                                    <i class="material-icons text-sm">delete_forever</i>
                                </button>';
                }else{
                    $delete = '';
                }

                $action = $restore.' '.$delete;
                return $action;
            })

            ->addColumn('description', function($row){
                $description = substr(strip_tags($row->description), 0, 100);
                return mb_convert_encoding($description, 'UTF-8', 'UTF-8');
            })

            ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	        ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')

            ->setRowId('id')
            ->rawColumns(['action','checkbox','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\VideoPlaylist $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VideoPlaylist $model): QueryBuilder
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
                    ->setTableId('videos-table')
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
        return 'videoplaylists_' . date('YmdHis');
    }
}
