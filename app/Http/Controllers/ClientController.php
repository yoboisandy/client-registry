<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Libs\APIResponse;
use App\Services\ClientServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Create a new class instance.
     *
     * @param ClientServiceInterface $clientService
     */
    public function __construct(public ClientServiceInterface $clientService)
    {
    }

    /**
     * Store a newly added client in csv.
     *
     * @param ClientRequest $request
     * @return JsonResponse
     */
    public function store(ClientRequest $request): JsonResponse
    {
        $client = (object) $this->clientService->addClient($request->validated());
        return APIResponse::success(new ClientResource($client), 'Client added successfully.');
    }

    /**
     * Get all clients from csv.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $clients = (object) $this->clientService->getClients($request->query('page', 1));

        return APIResponse::success([
            'data' => ClientResource::collection((object) $clients->data),
            'pagination' => $clients->pagination
        ], 'Clients retrieved successfully.');
    }
}
