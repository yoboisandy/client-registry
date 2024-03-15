<?php

namespace App\Services;

interface ClientServiceInterface
{
    public function addClient(array $data): array;
    public function getClients(int $pageNumber): array;
}
