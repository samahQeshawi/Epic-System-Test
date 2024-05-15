<?php

namespace App\DataTables;

use App\Models\Package;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PackagesDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.packages.actions')
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            });

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Package $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Package $model): QueryBuilder
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
                    ->setTableId('packages-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
//                    ->selectStyleSingle()
                    ->buttons([
//                Button::make('export'),
//                Button::make('excel'),
//                Button::make('csv'),
//                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),//
                Button::make('reload'),//

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
            Column::make('price'),
            Column::make('num_invitations'),
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
        return 'Packages_' . date('YmdHis');
    }
}
