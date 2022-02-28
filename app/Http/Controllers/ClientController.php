<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Repositories\AutomobileRepository;
use App\Repositories\ClientRepository;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    private $client;
    private $automobile;

    public function __construct()
    {
        $this->automobile = new AutomobileRepository();
        $this->client = new ClientRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */

    public function index(): JsonResponse
    {
        return response()->json($this->client->getWithPaginate());
    }

    public function deactivateClients(): JsonResponse
    {
        return response()->json($this->client->deactivateClients());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @return void
     */

    public function store(StoreClientRequest $request)
    {
        $this->client->storeClient($request->input('client'));
        $id = $this->client->getIdByPhone($request->input('client.phone'));
        $this->automobile->storeAutomobile($request->input('client.cars'), $id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->client->showClient($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientRequest $request
     * @param int $id
     */
    public function update(UpdateClientRequest $request, int $id)
    {
        $this->client->updateClient($request->input('client'), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->client->deleteClient($id);
    }
}
