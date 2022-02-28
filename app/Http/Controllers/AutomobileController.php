<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAutomobileRequest;
use App\Http\Requests\UpdateAutomobileRequest;
use App\Repositories\AutomobileRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AutomobileController extends Controller
{
    private $automobile;

    public function __construct()
    {
        $this->automobile = new AutomobileRepository();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAutomobileRequest $request
     * @return void
     */
    public function store(StoreAutomobileRequest $request)
    {
        $this->automobile->storeAutomobile($request->input('newCars'));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getCarClient($id): JsonResponse
    {
        return response()->json($this->automobile->getCarClient($id));
    }

    public function getActiveCars(): JsonResponse
    {
        return response()->json($this->automobile->getCarsInParking());
    }

    public function activeStatus($number)
    {
        $this->automobile->enableCarStatus($number);
    }

    public function deActiveStatus($number)
    {
        $this->automobile->disableCarStatus($number);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAutomobileRequest $request
     * @return void
     */
    public function update(UpdateAutomobileRequest $request)
    {
        $this->automobile->updateAutomobile($request->input('cars'));
        $this->automobile->enableCarStatus($request->input('number'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->automobile->deleteAuto($id);
    }
}
