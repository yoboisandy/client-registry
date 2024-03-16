<?php

namespace App\Services;

use Illuminate\Support\Collection;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;

class CSVService implements CSVServiceInterface
{
    /**
     * Create a csv file.
     *
     * @param string $filename
     * @return boolean
     */
    public function createCSV(string $filename): bool
    {
        if (!is_dir(storage_path('app/public/csv'))) {
            mkdir(storage_path('app/public/csv'));
        }
        $csv = Writer::createFromPath(storage_path("app/public/csv/{$filename}"), 'w+');
        $csv->insertOne(['id', 'name', 'email', 'phone', 'address', 'gender', 'nationality', 'dob', 'education', 'mode_of_contact', 'image']);
        return true;
    }

    /**
     * Check if a csv file exists.
     *
     * @param string $filename
     * @return boolean
     */
    public function checkCSVExists(string $filename): bool
    {
        return file_exists(storage_path("app/public/csv/{$filename}"));
    }

    /**
     * Append data to a csv file.
     *
     * @param string $filename
     * @param array $data
     * @return array
     */
    public function appendToCSV(string $filename, array $data): array
    {
        if (!$this->checkCSVExists($filename)) {
            $this->createCSV($filename);
        }
        $csvData = $this->dataForCsv($data);
        $csv = Writer::createFromPath(storage_path("app/public/csv/{$filename}"), 'a+');
        $csv->insertOne($csvData);
        return $csvData;
    }

    /**
     * Prepare data for csv.
     *
     * @param array $data
     * @return array
     */
    private function dataForCsv(array $data): array
    {
        return [
            'id' => uniqid(),
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'gender' => $data['gender'],
            'nationality' => $data['nationality'],
            'dob' => $data['dob'],
            'education' => $data['education'],
            'mode_of_contact' => $data['mode_of_contact'],
            'image' => $data['image'] ?? null
        ];
    }

    /**
     * Read data from a csv file.
     *
     * @param string $filename
     * @return Collection
     */
    public function readCSV(string $filename, $pageNumber = 1): Collection
    {
        if (!$this->checkCSVExists($filename)) {
            return collect([]);
        }
        $csv = Reader::createFromPath(storage_path("app/public/csv/{$filename}"), 'r');
        $csv->setHeaderOffset(0);

        $stmt = Statement::create()
            ->offset(($pageNumber - 1) * config('pagination.page_size'))
            ->limit(config('pagination.page_size'));

        $records = $stmt->process($csv);

        return collect($records)->map(function ($record) {
            $record["image"] = empty($record["image"]) ? null : $record["image"];
            return (object) $this->dataForCsv($record);
        })->values();
    }

    /**
     * Get the total number of records in a csv file.
     *
     * @param string $filename
     * @return int
     */
    public function totalRecords(string $filename): int
    {
        if (!$this->checkCSVExists($filename)) {
            return 0;
        }
        $csv = Reader::createFromPath(storage_path("app/public/csv/{$filename}"), 'r');
        $csv->setHeaderOffset(0);
        return iterator_count($csv);
    }

    /**
     * Get pagination data.
     *
     * @param string $filename
     * @return Collection
     */
    public function paginationData(string $filename, int $currentPage): array
    {
        $totalRecords = $this->totalRecords($filename);
        $pageSize = config('pagination.page_size');
        $totalPages = ceil($totalRecords / $pageSize);
        return [
            'total_records' => $totalRecords,
            'total_pages' => $totalPages,
            'page_size' => (int) $pageSize,
            'current_page' => $currentPage,
        ];
    }
}
