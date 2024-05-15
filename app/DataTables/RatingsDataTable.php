<?php

namespace App\DataTables;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RatingsDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.ratings.actions')
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->editColumn('rate', function ($query) {
                if($query->rate == 5){
                    return '<span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star" style="color: orange;"></span>';
                }elseif ($query->rate == 4){
                    return '<span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star"></span>';
                }elseif ($query->rate == 3){
                    return '<span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>';
                }elseif ($query->rate == 2){
                    return '<span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>';
                }elseif ($query->rate == 1){
                    return '<span class="fa fa-star" style="color: orange;"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>';
                }

            })
            ->editColumn('status', function ($query) {
                if ($query->status == 'active'){
                    return '<span class="badge badge-pill badge-light-success mr-1">مفعل</span>';
                }else{
                    return '<span class="badge badge-pill badge-light-warning mr-1">غير مفعل</span>';
                }
            })->rawColumns(['status','action','rate']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Rating $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Rating $model): QueryBuilder
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('ratings-table')
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
            Column::make('user.first_name')->title('User Name'),
            Column::make('rate'),
            Column::make('status'),
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
        return 'Ratings_' . date('YmdHis');
    }

}
