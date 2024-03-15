<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Libs\APIResponse;
use App\Services\ClientServiceInterface;
use Illuminate\Http\JsonResponse;

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
}
