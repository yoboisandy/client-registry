<?php

namespace App\Services;

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
        if(!is_dir(storage_path('app/public/csv'))){
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
}
