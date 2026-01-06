<?php

namespace Modules\Product\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Models\ProductChild;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ProductsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Products';

        // module name
        $this->module_name = 'products';

        // directory path of the module
        $this->module_path = 'product::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Product\Models\Product";
    }
    /**
     * Store a newly created product along with children and configurations.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        $module_action = 'Store';

        $validated_request = $request->validate([
            'item_code' => 'required|string|max:255|unique:products,item_code',
            'name' => 'required|string|max:200',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'sub_cat_id' => 'nullable|exists:sub_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'in_stock' => 'required|integer|min:0',
            'unit_id' => 'required|exists:units,id',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'type' => 'required|in:single,configurable',
            'children' => 'nullable|array',
            'children.*.name' => 'required_with:children|string|max:200',
            'children.*.price' => 'required_with:children|numeric|min:0',
            'children.*.quantity' => 'required_with:children|numeric|min:0',
            'children.*.weight' => 'nullable|numeric|min:0',
            'children.*.unit_id' => 'required_with:children|exists:units,id',
            'configurations' => 'nullable|array',
            'configurations.is_subscribable' => 'boolean',
            'configurations.is_container' => 'boolean',
            'configurations.is_feature' => 'boolean',
            'configurations.is_taxable' => 'boolean',
        ]);

        $$module_name_singular = $module_model::create($validated_request);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $$module_name_singular->update(['image' => $imagePath]);
        }

        // Store Product Children if applicable
        if ($request->has('children')) {
            foreach ($request->children as $childData) {
                $$module_name_singular->children()->create($childData);
            }
        }

        // Store Product Configurations if applicable
        if ($request->has('configurations')) {
            $$module_name_singular->configurations()->create($request->configurations);
        }

        flash("New '" . Str::singular($module_title) . "' Added")->success()->important();
        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        return redirect("admin/{$module_name}");
    }

    /**
     * Update the specified product along with its children and configurations.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        $module_action = 'Update';

        $validated_request = $request->validate([
            'item_code' => 'required|string|max:255|unique:products,item_code,' . $id,
            'name' => 'required|string|max:200',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $id,
            'category_id' => 'required|exists:categories,id',
            'sub_cat_id' => 'nullable|exists:sub_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'in_stock' => 'required|integer|min:0',
            'unit_id' => 'required|exists:units,id',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'type' => 'required|in:single,configurable',
            'children' => 'nullable|array',
            'children.*.id' => 'nullable|exists:product_children,id',
            'children.*.name' => 'required_with:children|string|max:200',
            'children.*.price' => 'required_with:children|numeric|min:0',
            'children.*.quantity' => 'required_with:children|numeric|min:0',
            'children.*.weight' => 'nullable|numeric|min:0',
            'children.*.unit_id' => 'required_with:children|exists:units,id',
            'configurations' => 'nullable|array',
            'configurations.is_subscribable' => 'boolean',
            'configurations.is_container' => 'boolean',
            'configurations.is_feature' => 'boolean',
            'configurations.is_taxable' => 'boolean',
        ]);

        $$module_name_singular = $module_model::findOrFail($id);
        $$module_name_singular->update($validated_request);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $$module_name_singular->update(['image' => $imagePath]);
        }

        // Update or create product children
        if ($request->has('children')) {
            foreach ($request->children as $childData) {
                if (isset($childData['id'])) {
                    ProductChild::where('id', $childData['id'])->update($childData);
                } else {
                    $$module_name_singular->children()->create($childData);
                }
            }
        }

        // Update or create product configurations
        if ($request->has('configurations')) {
            $$module_name_singular->configurations()->updateOrCreate(
                ['product_id' => $$module_name_singular->id],
                $request->configurations
            );
        }

        flash(Str::singular($module_title) . "' Updated Successfully")->success()->important();
        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        return redirect()->route("admin.{$module_name}.show", $$module_name_singular->id);
    }
}
