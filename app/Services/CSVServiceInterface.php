<?php

namespace App\Services;

interface CSVServiceInterface
{
    public function createCSV(string $filename): bool;
    public function checkCSVExists(string $filename): bool;
    public function appendToCSV(string $filename, array $data): array;
}
