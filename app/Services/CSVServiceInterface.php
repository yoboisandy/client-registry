<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface CSVServiceInterface
{
    public function createCSV(string $filename): bool;
    public function checkCSVExists(string $filename): bool;
    public function appendToCSV(string $filename, array $data): array;
    public function readCSV(string $filename, int $pageNumber): Collection;
    public function paginationData(string $filename, int $pageNumber): array;
    public function deleteCsvFileIfExist(string $filename): void;
    public function getCsvFileContent(string $filename): string;
}
