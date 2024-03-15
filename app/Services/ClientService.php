<?php

namespace App\Services;

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
        return $this->csvService->appendToCSV('clients.csv', $data);
    }
}
