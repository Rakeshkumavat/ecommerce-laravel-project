<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($data){

                $result     = "";

                if($data->status == 1) {
                    $result .= ' <button type="button" url="'.route('admin.status',$data->id).'" class="btn btn-success btn-sm status"   title="click to Inactivate" id="'.$data->id.'">Inactivate</button> ';
                } else {
                    $result .= ' <button type="button" url="'.route('admin.status',$data->id).'" class="btn btn-secondary btn-sm status"  title="click to Activate" id="'.$data->id.'">Activate</button> ';
                }
                $result .= '<a href="'.route('admin.category-edit',$data->id).'" class="btn btn-info btn-sm " title="Edit"><i class="fa fa-edit"></i></a>&nbsp';
                $result .= '<a href="'.route('admin.category-delete',$data->id).'" class="btn btn-danger btn-sm  delete_data" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                 return $result;
            })
            ->editColumn('image', function($data){
                if($data->image) {
                    return '<img src="'.asset("assets/images/$data->image").'" width=50px height=50px />';
                } else {
                    return '<img src="'.asset('images/no-image.png').'" width=50px height=50px/>';
                }
            })
            ->rawColumns(['action','image'])
            ->addIndexColumn();
    }


    public function query(Category $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            Column::make('name'),
            Column::make('image'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(400)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
