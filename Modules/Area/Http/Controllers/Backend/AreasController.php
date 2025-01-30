<?php

namespace Modules\Area\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Support\Str;
use Modules\Area\Http\Requests\StoreUpdateAreaRequest;
use Modules\Area\Services\AreaService;
use Illuminate\Http\Request;

class AreasController extends BackendBaseController
{
    use Authorizable;

    private $moduleAttributes = [];

    protected $areaService;

    public function __construct(AreaService $areaService)
    {

        parent::__construct();

        $this->areaService = $areaService;

        // Initialize module attributes in a reusable way
        // Page Title
        $this->module_title = 'Areas';

        // module name
        $this->module_name = 'areas';

        // directory path of the module
        $this->module_path = 'area::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = 'Modules\Area\Models\Area';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::paginate(15);

        //$existing_areas = $module_model::pluck('polygon_coords')->where('vendor_id', auth()->user()->id)->toArray();

        logUserAccess($module_title . ' ' . $module_action);

        return view("{$module_path}.{$module_name}.index_datatable", compact('module_title', 'module_name', "{$module_name}", 'module_icon', 'module_name_singular', 'module_action'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        logUserAccess($module_title . ' ' . $module_action);

        return view(
            "{$module_path}.{$module_name}.create",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Edit';

        $$module_name_singular = $module_model::findOrFail($id);

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        $existing_areas = $module_model::pluck('polygon_coords')->where('vendor_id', auth()->user()->id)->toArray();

        return view(
            "{$module_path}.{$module_name}.edit",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'existing_areas', "{$module_name_singular}")
        );
    }

    /**
     * Store a newly created Area.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = app(StoreUpdateAreaRequest::class)->validated();

        $this->areaService->storeArea($validated);

        return redirect()->route('areas.index')->with('success', 'Area created successfully.');
    }

    /**
     * Update the specified Area.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Manually validate the request using StoreUpdateAreaRequest
        $validated = (new StoreUpdateAreaRequest())->validate($request);

        $this->areaService->updateArea($id, $validated);

        return redirect()->route('areas.index')->with('success', 'Area updated successfully.');
    }
}
