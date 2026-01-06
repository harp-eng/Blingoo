<?php

namespace App\Http\Controllers\API\Customer\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use Illuminate\Support\Facades\Cache;
use Modules\Banner\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Cache::rememberForever('banners', function () {
            return Banner::all();
        });

        return BannerResource::collection($banners);
    }
}
