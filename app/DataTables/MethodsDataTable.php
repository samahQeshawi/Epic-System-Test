<?php

namespace App\DataTables;

use App\Models\Design;
use App\Models\Method;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MethodsDataTable extends DataTable
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
            ->addColumn('title_ar', function ($query) {
                return $query->getTranslation('title', 'ar');
            })
            ->addColumn('title_en', function ($query) {
                return $query->getTranslation('title', 'en');
            })
            ->addColumn('action', 'dashboard.methods.actions')
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->editColumn('image', function ($query) {
                return '<a href="'.$query->image.'" target="_blank"><img src="'.$query->image.'" style="height: 50px; width: 50px"
        class="img-thumbnail img-preview"></a>';
            })->rawColumns(['image','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Method $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Method $model): QueryBuilder
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
            ->setTableId('designs-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
//                        Button::make('export'),
//                        Button::make('excel'),
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
            Column::computed('title_ar'),
            Column::computed('title_en'),
            Column::make('image'),
            Column::make('created_at'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Methods_' . date('YmdHis');
    }
}
