<?php

namespace App\Http\Controllers\API\Customer\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use Illuminate\Support\Facades\Cache;
use Modules\Banner\Models\Banner;

class BannerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/banners",
     *     summary="Swagger test endpoint",
     *     tags={"Test"},
     *     @OA\Response(
     *         response=200,
     *         description="Swagger is working"
     *     )
     * )
     */
    public function index()
    {
        $banners = Cache::rememberForever('banners', function () {
            return Banner::all();
        });

        return BannerResource::collection($banners);
    }
}
