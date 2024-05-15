<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.users.actions')
            ->editColumn('created_at', function ($query) {
                return $query->created_at->toDateTimeString();
            })
            ->editColumn('city_name', function ($query) {
                if ($query->city_id != null){
                    return @$query->city->getTranslation('name', 'ar');
                }else{
                    return '--';
                }
            })
            ->editColumn('status', function ($query) {
                if ($query->is_verify == 1){
                    return '<span class="badge badge-pill badge-light-success mr-1">Verify</span>';
                }else{
                    return '<span class="badge badge-pill badge-light-warning mr-1">Not Verify</span>';
                }
            })->rawColumns(['status','action']);

    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->with('city');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->buttons(
//Button::make('create'),
//                Button::make('export'),
//                Button::make('excel'),
//                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('phone'),
            Column::make('first_name'),
            Column::make('last_name'),
            Column::computed('city_name'),
            Column::computed('status'),
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
        return 'Users_' . date('YmdHis');
    }
}
