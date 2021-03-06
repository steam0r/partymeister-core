<?php

namespace Partymeister\Core\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Motor\Backend\Http\Controllers\Controller;
use Partymeister\Core\Http\Requests\Backend\ScheduleRequest;
use Partymeister\Core\Models\Schedule;
use Partymeister\Core\Services\ScheduleService;
use Partymeister\Core\Transformers\ScheduleTransformer;

/**
 * Class SchedulesController
 * @package Partymeister\Core\Http\Controllers\Api
 */
class SchedulesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $paginator = ScheduleService::collection()->getPaginator();
        $resource  = $this->transformPaginator($paginator, ScheduleTransformer::class);

        return $this->respondWithJson('Schedule collection read', $resource);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ScheduleRequest $request
     * @return JsonResponse
     */
    public function store(ScheduleRequest $request)
    {
        $result   = ScheduleService::create($request)->getResult();
        $resource = $this->transformItem($result, ScheduleTransformer::class);

        return $this->respondWithJson('Schedule created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param Schedule $record
     * @return JsonResponse
     */
    public function show(Schedule $record)
    {
        $result   = ScheduleService::show($record)->getResult();
        $resource = $this->transformItem($result, ScheduleTransformer::class);

        return $this->respondWithJson('Schedule read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ScheduleRequest $request
     * @param Schedule        $record
     * @return JsonResponse
     */
    public function update(ScheduleRequest $request, Schedule $record)
    {
        $result   = ScheduleService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, ScheduleTransformer::class);

        return $this->respondWithJson('Schedule updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $record
     * @return JsonResponse
     */
    public function destroy(Schedule $record)
    {
        $result = ScheduleService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Schedule deleted', [ 'success' => true ]);
        }

        return $this->respondWithJson('Schedule NOT deleted', [ 'success' => false ]);
    }
}
