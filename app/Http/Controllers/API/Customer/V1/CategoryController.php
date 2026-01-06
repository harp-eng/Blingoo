<?php

namespace App\Http\Controllers\API\Customer\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Cache;
use Modules\Category\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Cache::rememberForever('categories', function () {
            return Category::all();
        });

        return CategoryResource::collection($categories);
    }
}
