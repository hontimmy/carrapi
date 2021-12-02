<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\EService;
use Illuminate\Support\Facades\DB;

/**
 * Class EServiceController
 * @package App\Http\Controllers\API
 */
class ServiceController extends Controller
{

    public function ServiveFeat()
    {
        $eServices = EService::where('featured', 1)->where('available', 1)->get();

        return $this->sendResponse($eServices, 'Services retrieved successfully');
    }


    public function ServivePopular()
    {

        $eServices = EService::where('featured', 1)->where('available', 1)->get();

        return $this->sendResponse($eServices, 'Services retrieved successfully');
    }

    public function ServiveToprated()
    {

        $eServices = EService::leftJoin('e_service_reviews', 'e_service_reviews.e_service_id', '=', 'e_services.id')
            ->select([
                'e_services.*',
                DB::raw('AVG(e_service_reviews.rate) as ratings_average')
            ])
            ->orderBy('ratings_average', 'desc')
            ->take(20)
            ->get();
        return $this->sendResponse($eServices, 'Services retrieved successfully');
    }

    public function searchService()
    {
        $this->validate(request(), [
            'keyword' => 'required',
        ]);

        $eServices = EService::where('name', 'like', '%' . request()->keyword . '%')->get();

        return $this->sendResponse($eServices, 'Services retrieved successfully');
    }
}
