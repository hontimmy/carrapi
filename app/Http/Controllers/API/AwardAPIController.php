<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Repositories\AwardRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;


class AwardAPIController extends Controller
{
    /** @var  AwardRepository */
    private $awardRepository;

    public function __construct(AwardRepository $awardRepo)
    {
        $this->awardRepository = $awardRepo;
    }

    /**
     * Display a listing of the Award.
     * GET|HEAD /awards
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $this->awardRepository->pushCriteria(new RequestCriteria($request));
            $this->awardRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $awards = $this->awardRepository->all();

        return $this->sendResponse($awards->toArray(), 'Awards retrieved successfully');
    }

    /**
     * Display the specified Award.
     * GET|HEAD /awards/{id}
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        /** @var Award $award */
        if (!empty($this->awardRepository)) {
            $award = $this->awardRepository->findWithoutFail($id);
        }

        if (empty($award)) {
            return $this->sendError('Award not found');
        }

        return $this->sendResponse($award->toArray(), 'Award retrieved successfully');
    }
}
