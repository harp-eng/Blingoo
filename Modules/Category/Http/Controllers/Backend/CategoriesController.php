<?php

namespace Modules\Category\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class CategoriesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Categories';

        // module name
        $this->module_name = 'categories';

        // directory path of the module
        $this->module_path = 'category::backend';

        // module icon
        $this->module_icon = 'fa-solid fa-diagram-project';

        // module model name, path
        $this->module_model = "Modules\Category\Models\Category";
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

        $$module_name = $module_model::select('id', 'name', 'status', 'parent_id', 'updated_at')->with(['media', 'parent']);

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('name', '<strong>{{$name}}</strong>')
            ->editColumn('parent_id', function ($item) {
                if ($item->parent) {
                    return '<strong>' . e($item->parent->name) . '</strong>';
                }
                return '-'; 
            })
            ->addColumn('image', function ($item) {
                $url = $item->getFirstMediaUrl($this->module_name);
                if ($url) {
                    return '<img src="' . e($url) . '" alt="Image" style="max-width:50px; height:auto;">';
                }
                return '';
            })
            ->editColumn('updated_at', function ($data) {

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                }

                return $data->updated_at->isoFormat('llll');
            })->editColumn('status', function ($data) {
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
                            ' . $checked . '>
                        <label class="form-check-label" for="switch_' . $data->id . '">
                            ' . ($data->status ? 'Enabled' : 'Disabled') . '
                        </label>
                    </div>
                ';
            })
            ->rawColumns(['name', 'action', 'status', 'parent_id', 'image'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';

        $validated_request = $request->validate([
            'name' => 'required|max:191|unique:' . $module_model . ',name',
            'slug' => 'nullable|max:191|unique:' . $module_model . ',slug',
            'group_name' => 'nullable|max:191',
            'description' => 'nullable',
            'meta_title' => 'nullable|max:191',
            'meta_description' => 'nullable',
            'meta_keyword' => 'nullable',
            'order' => 'nullable|integer',
            'status' => 'nullable|max:191',
        ]);

        $$module_name_singular = $module_model::create($request->only('name', 'slug', 'description', 'order', 'status'));

        if ($request->image) {
            $media = $$module_name_singular->addMedia($request->file('image'))->toMediaCollection($module_name);
            $$module_name_singular->image = $media->getUrl();
            $$module_name_singular->save();
        }

        // Store Meta Data
        $$module_name_singular->metaData()->create([
            'meta_title'       => $request->input('meta_title'),
            'meta_keywords'    => $request->input('meta_keywords'),
            'meta_description' => $request->input('meta_description')
        ]);

        flash("New '" . Str::singular($module_title) . "' Added")->success()->important();

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        return redirect("admin/{$module_name}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        $$module_name_singular = $module_model::findOrFail($id);

        $posts = $$module_name_singular->posts()->latest()->paginate();

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        return view(
            "{$module_path}.{$module_name}.show",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', "{$module_name_singular}", 'posts')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $validated_request = $request->validate([
            'name' => 'required|max:191|unique:' . $module_model . ',name,' . $id,
            'slug' => 'nullable|max:191|unique:' . $module_model . ',slug,' . $id,
            'group_name' => 'nullable|max:191',
            'description' => 'nullable',
            'meta_title' => 'nullable|max:191',
            'meta_description' => 'nullable',
            'meta_keyword' => 'nullable',
            'order' => 'nullable|integer',
            'status' => 'required|max:191',
        ]);

        $$module_name_singular = $module_model::findOrFail($id);

        $$module_name_singular->update($request->except('image', 'image_remove', 'meta_title', 'meta_description', 'meta_keyword'));

        // Image
        if ($request->hasFile('image')) {
            if ($$module_name_singular->getMedia($module_name)->first()) {
                $$module_name_singular->getMedia($module_name)->first()->delete();
            }
            $media = $$module_name_singular->addMedia($request->file('image'))->toMediaCollection($module_name);

            $$module_name_singular->image = $media->getUrl();

            $$module_name_singular->save();
        }
        if ($request->image_remove === 'image_remove') {
            if ($$module_name_singular->getMedia($module_name)->first()) {
                $$module_name_singular->getMedia($module_name)->first()->delete();

                $$module_name_singular->image = '';

                $$module_name_singular->save();
            }
        }

        // Store or Update Meta Data
        $$module_name_singular->metaData()->updateOrCreate(
            [
                'model_type' => get_class($$module_name_singular), // Ensure correct model type
                'model_id'   => $$module_name_singular->id,
            ],
            [
                'meta_title'       => $request->input('meta_title'),
                'meta_keywords'    => $request->input('meta_keywords'),
                'meta_description' => $request->input('meta_description'),
            ]
        );


        flash(Str::singular($module_title) . "' Updated Successfully")->success()->important();

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        return redirect()->route("backend.{$module_name}.show", $$module_name_singular->id);
    }
}
