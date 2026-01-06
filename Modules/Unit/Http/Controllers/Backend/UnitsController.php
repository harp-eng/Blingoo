<?php

namespace Modules\Unit\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;


use Carbon\Carbon;

use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UnitsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Units';

        // module name
        $this->module_name = 'units';

        // directory path of the module
        $this->module_path = 'unit::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Unit\Models\Unit";
    }

    /**
     * Retrieves the data for the index page of the module.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $page_heading = label_case($module_title);
        $title = $page_heading . ' ' . label_case($module_action);

        $$module_name = $module_model::select('id', 'name', 'status', 'updated_at');

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('name', '<strong>{{$name}}</strong>')
            ->editColumn('status', function ($data) {
                $checked = $data->status ? 'checked' : '';
                return '
                    <div class="form-check form-switch">
                        <input 
                            class="form-check-input toggle-status" 
                            type="checkbox" 
                            role="switch" 
                            id="switch_' . $data->id . '" 
                            name="status" 
                            data-id="' . $data->id . '" 
                            data-url="' . route("backend.updateStatus") . '" 
                            ' . $checked . '>
                        <label class="form-check-label" for="switch_' . $data->id . '">
                            ' . ($data->status ? 'Enabled' : 'Disabled') . '
                        </label>
                    </div>
                ';
            })


            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }

                return $data->updated_at->isoFormat('llll');
            })
            ->rawColumns(['name', 'status', 'action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }
}
