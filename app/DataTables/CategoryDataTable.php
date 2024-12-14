<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query->with(['parent'])->select('categories.*')))
            ->editColumn('serial_number', function ($category) {
                static $index = 1;
                return $index++;
            })
            ->editColumn('status', function ($category) {
                return $category->status == 1
                    ? '<span class="badge badge-success">Enabled</span>'
                    : '<span class="badge badge-danger">Disabled</span>';
            })
            ->editColumn('parent', function ($category) {
                return $category->parent ? $category->parent->full_path : 'None';
            })
            ->editColumn('created_at', function ($category) {
                return $category->created_at ? $category->created_at->format('d-m-Y H:i') : 'N/A';
            })
            ->editColumn('updated_at', function ($category) {
                return $category->updated_at ? $category->updated_at->format('d-m-Y H:i') : 'N/A';
            })
            ->addColumn('action', function ($record) {
                $actionHtml = '';
                if (auth()->user()->permission('category_edit')) {
                    $actionHtml .= '<a href="javascript:void(0)" class="btn btn-sm ' . ($record->status == 1 ? 'btn-danger' : 'btn-success') . ' gap-2" id="toggleStatusBtn" data-category-id="' . $record->id . '" data-status="' . $record->status . '" onclick="toggleCategoryStatus(event)">' . ($record->status == 1 ? 'Disable' : 'Enable') . '</a>';
                }
                if (auth()->user()->permission('category_edit')) {
                    $actionHtml .= '<a href="javascript:void(0)" class="btn btn-sm btn-primary editBtn gap-2" onclick="editBtn(' . $record->id . ')" data-category-id="' . $record->id . '">Edit</a>';
                }
                if (auth()->user()->permission('category_delete')) {
                    $actionHtml .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger deleteCategoryBtn gap-2" data-href="' . route('categories.destroy', $record->id) . '">Delete</a>';
                }

                return $actionHtml;
            })

            // Search filter
            ->filter(function ($query) {
                if ($search = request()->get('search')['value']) {
                    $query->where(function ($query) use ($search) {
                        // Search in category name
                        $query->where('categories.name', 'like', '%' . $search . '%')
                            // Or search in parent's name
                            ->orWhereHas('parent', function ($query) use ($search) {
                                $query->where('categories.name', 'like', '%' . $search . '%');
                            });
                    });
                }
            })
            
            // Row ID and raw columns
            ->setRowId('id')
            ->rawColumns(['action', 'status', 'parent']);
    }



    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $orderByColumn = 5;
        return $this->builder()
                    ->setTableId('category-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy($orderByColumn)
                    ->selectStyleSingle()
                    ->lengthMenu([
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, 'All']
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $columns = [];

        $columns[] = Column::computed('serial_number')
            ->title('#')
            ->width(50)
            ->addClass('text-center')
            ->searchable(false)
            ->sortable(false); 

        $columns[] = Column::make('name')
            ->title('Category Name')
            ->sortable(false);

        $columns[] = Column::make('status')
            ->title('Status')
            ->sortable(false);

        $columns[] = Column::make('parent')
            ->title('Parent')
            ->sortable(false);

        $columns[] = Column::make('created_at')
            ->title('Created Date')
            ->searchable(false)
            ->visible(true)
            ->sortable(true); 

        $columns[] = Column::make('updated_at')
            ->title('Updated Date')
            ->searchable(false)
            ->visible(true)
            ->sortable(true);

        $columns[] = Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->addClass('text-center')
            ->width('auto')
            ->sortable(false);

        return $columns;
    }



    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
