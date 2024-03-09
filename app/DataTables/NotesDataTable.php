<?php

namespace App\DataTables;

use App\Models\Notes;
use App\Models\User;
use App\Models\Status;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NotesDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'dashboard.notes.actions')
            ->editColumn('created_at',function($note){
                return date($note->created_at);
            })
            ->editColumn('updated_at',function($note){
                return date($note->created_at);
            });


    }

    public function query(Notes $model)
    {
        return $model->newQuery()->with(['user', 'status']);
    }


    public function html()
    {
        return $this->builder()
                    ->setTableId('notes-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(url("notes-datatable"))
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
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
            Column::make('title'),
            Column::make('content'),
            Column::make('note_type'),
            Column::make('applies_to_date'),
            Column::make('users_id')->data('user.name')->title('User Name'),
            Column::make('status_id')->data('status.name')->title('status Name'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(120)
            ->addClass('text-center'),
        ];
    }


    protected function filename()
    {
        return 'Notes_' . date('YmdHis');
    }
}
