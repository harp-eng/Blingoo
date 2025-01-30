<?php

namespace Modules\Area\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUpdateAreaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // You can add custom authorization logic here if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:125',
            'description' => 'nullable|string',
            'area_type' => 'required|in:polygon,postcode',
            'vendor_id' => 'nullable|integer|exists:vendors,id',
            'status' => 'required|string|in:Active,Inactive',
            'polygons' => 'required_if:area_type,polygon|array',
            'polygons.*.coordinates' => 'required|string',
            'polygons.*.sequence' => 'nullable|integer',
            'postcodes' => 'required_if:area_type,postcode|array',
            'postcodes.*' => 'required|string|max:20',
            'availability' => 'nullable|array',
            'availability.*.day' => 'required|string|max:10',
            'availability.*.available' => 'required|boolean',
        ];
    }
}
