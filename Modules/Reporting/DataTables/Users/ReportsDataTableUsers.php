<?php

namespace Modules\Reporting\DataTables\Users;

use Carbon\Carbon;
use Illuminate\Support\HtmlString;
use Modules\Reporting\Services\ReportService;
use Modules\Reporting\Entities\Report;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReportsDataTableUsers extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function __construct(ReportService $reportService)
    {
        $this->module_name = 'reports';

        $this->reportService = $reportService;
    }

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('category', function ($data) {
                $module_name = $this->module_name;

                $cateogry_name = $data->type->name;

                return $cateogry_name;
            })
            ->editColumn('available', function ($data) {
                $module_name = $this->module_name;

                if($data->available)
                {
                    $availability = '<p class="text-white text-center bg-success rounded">YES</p>';
                }else{
                    $availability = '<p class="text-white text-center bg-danger rounded">NO</p>';
                }

                return $availability;
            })
            ->editColumn('photo', function ($data) {
                $module_name = $this->module_name;

                $pictureView = '<img src="'.asset($data->photo).'" class="user-profile-image img-fluid img-thumbnail" style="max-height:150px; max-width:100px;" />';

                return $pictureView;
            })
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                } else {
                    return $data->updated_at->isoFormat('LLLL');
                }
            })
            ->editColumn('created_at', function ($data) {
                $module_name = $this->module_name;

                $formated_date = Carbon::parse($data->created_at)->format('d-m-Y, H:i:s');

                return $formated_date;
            })
            ->rawColumns(['name', 'action','photo','available']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Report $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $user = auth()->user();
        $data = Report::where('created_by','=',$user->id);

        return $this->applyScopes($data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $created_at = 1;
        return $this->builder()
                ->setTableId('reports-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom(config('mk-datatables.mk-dom'))
                ->orderBy($created_at,'desc')
                ->buttons(
                    Button::make('colvis')->text('Kolom')->className('m-2 rounded btn-info'),
                )->parameters([
                    'paging' => true,
                    'searching' => true,
                    'info' => true,
                    'responsive' => true,
                    'autoWidth' => false,
                    'searchDelay' => 350,
                ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center'),
            Column::make('id')->hidden(),
            Column::make('reporter')->title(__("reporting::reports.reporter")),
            Column::make('reporter_type')->title(__("reporting::reports.reporter_type"))->hidden(),
            Column::make('category')->title(__("reporting::reports.category")),
            Column::make('reporter_email')->title(__("reporting::reports.reporter_email"))->hidden(),
            Column::make('title')->title(__("reporting::reports.title")),
            Column::make('status')->title(__("reporting::reports.status")),
            Column::make('created_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Reports_' . date('YmdHis');
    }
}