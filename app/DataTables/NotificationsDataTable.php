<?php

namespace App\DataTables;

use App\Models\Notification;
use App\Models\Notify;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NotificationsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('action', 'dashboard.notifications.actions')

//            ->editColumn('created_at', function ($query) {
//                return $query->created_at->toDateTimeString();
//            })
            ->editColumn('status', function ($query) {
                if ($query->status == 'active'){
                    return '<span class="badge badge-pill badge-light-success mr-1">مرسلة</span>';
                }else{
                    return '<span class="badge badge-pill badge-light-warning mr-1">غير مرسلة</span>';
                }
            })->rawColumns(['status','action']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Notify $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notify $model): QueryBuilder
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
                    ->setTableId('notifications-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
//                        Button::make('excel'),
//                        Button::make('csv'),
//                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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

            Column::make('id'),
            Column::make('title'),
            Column::make('body'),
            Column::make('status'),
//            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Notifications_' . date('YmdHis');
    }
}
