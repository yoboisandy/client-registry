<?php

namespace App\Services;

use Illuminate\Support\Collection;

class ClientService implements ClientServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(public CSVServiceInterface $csvService)
    {
        //
    }

    /**
     * Add a new client.
     *
     * @param array $data
     * @return array
     */
    public function addClient(array $data): array
    {
        return $this->csvService->appendToCSV(config('app.csv'), $data);
    }

    /**
     * Get all clients.
     *
     * @return array
     */
    public function getClients($pageNumber = 1): array
    {
        return [
            "data" => $this->csvService->readCSV(config('app.csv'), $pageNumber),
            "pagination" => $this->csvService->paginationData(config('app.csv'), $pageNumber)
        ];
    }
}
