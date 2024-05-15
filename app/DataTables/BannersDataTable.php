<?php

namespace App\DataTables;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BannersDataTable extends DataTable
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
            ->addColumn('name_ar', function ($query) {
                return $query->getTranslation('name', 'ar');
            })
            ->addColumn('name_en', function ($query) {
                return $query->getTranslation('name', 'en');
            })

            ->addColumn('action', 'dashboard.banners.actions')
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->editColumn('image', function ($query) {
                return '<a href="'.$query->image.'" target="_blank"><img src="'.$query->image.'" style="height: 50px; width: 70px"
        class="img-thumbnail img-preview"></a>';

            })->rawColumns(['image','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Banner $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Banner $model): QueryBuilder
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
            ->setTableId('banners-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
//                Button::make('export'),
//                Button::make('excel'),
//                Button::make('pdf'),
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
            Column::computed('name_ar'),
            Column::computed('name_en'),
            Column::make('image'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
            ,

        ];
    }
    protected function filename(): string
    {
        return 'Banners_' . date('YmdHis');
    }
}
