<?php

namespace Modules\Reporting\Http\Controllers\Frontend;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;
use Auth;
use Modules\Reporting\Services\ReportService;
use Spatie\Activitylog\Models\Activity;

class ReportsController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        // Page Title
        $this->module_title = trans('menu.reporting.reports');

        // module name
        $this->module_name = 'reports';

        // directory path of the module
        $this->module_path = 'reports';

        // module icon
        $this->module_icon = 'fas fa-user-tie';

        // module model name, path
        $this->module_model = "Modules\Report\Entities\Report";

        $this->reportService = $reportService;
    }

    /**
     * Go to report homepage
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Index';

        $reports = $this->reportService->getAllReports()->data;

        //determine connections
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
       
        return view(
            "reporting::frontend.$module_name.index",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action', "reports",'driver')
        );
    }


    /**
     * Go to report catalog
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function indexPaginated(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Index';

        $reports = $this->reportService->getPaginatedReports(20,$request)->data;
        
        if ($request->ajax()) {
            return view("reporting::frontend.$module_name.reports-card-loader", ['reports' => $reports])->render();  
        }
        
        //determine connections
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
       
        return view(
            "reporting::frontend.$module_name.index",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action', "reports",'driver')
        );
    }

    /**
     * Go to report catalog
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function filterReports(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Index';

        $reports = $this->reportService->filterReports(20,$request)->data;
        
        if ($request->ajax()) {
            return view("reporting::frontend.$module_name.reports-card-loader", ['reports' => $reports])->render();  
        }
        
    }


    /**
     * Show report details
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show($id,$reportId)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Index';

        $report = $this->reportService->show($id)->data;
        
        
        //determine connections
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
       
        return view(
            "reporting::frontend.$module_name.show",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action', "report",'driver')
        );
    }
}
