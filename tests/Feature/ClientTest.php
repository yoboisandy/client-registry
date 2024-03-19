<?php

namespace Tests\Feature;

use App\Services\CSVServiceInterface;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ClientTest extends TestCase
{
    protected $csvService;

    public function setUp(): void
    {
        parent::setUp();
        $this->csvService = $this->app->make(CSVServiceInterface::class);
    }

    /**
     * Test adding a client record.
     */
    public function test_can_add_a_client_to_csv(): void
    {
        $this->csvService->deleteCsvFileIfExist(config('app.csv'));
        $data = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'phone' => '9845677455',
            'address' => 'Bharatpur, Nepal',
            'gender' => 'male',
            'nationality' => 'Nepali',
            'dob' => '1990-01-01',
            'education' => 'bachelor',
            'mode_of_contact' => 'email',
        ];
        $response = $this->postJson('/api/clients', $data);

        $response->assertStatus(200);

        $csvFileContent = $this->csvService->getCsvFileContent(config('app.csv'));
        $this->assertStringContainsString('John Doe', $csvFileContent);
        $this->assertStringContainsString('john@gmail.com', $csvFileContent);
    }

    /**
     * Test getting all clients.
     */
    public function test_can_get_all_clients_from_csv(): void
    {
        $records = [
            [
                'name' => 'John Doe',
                'email' => 'john@gmail.com',
                'phone' => '9845677455',
                'address' => 'Bharatpur, Nepal',
                'gender' => 'male',
                'nationality' => 'Nepali',
                'dob' => '1990-01-01',
                'education' => 'bachelor',
                'mode_of_contact' => 'email',
            ],
            [
                'name' => 'David Smith',
                'email' => 'david@gmail.com',
                'phone' => '9347488388',
                'address' => 'Kathmandu, Nepal',
                'gender' => 'male',
                'nationality' => 'Nepali',
                'dob' => '2001-01-04',
                'education' => 'phd',
                'mode_of_contact' => 'phone',
            ]
        ];

        $responses = [];
        foreach ($records as $record) {
            $responses[] = $this->csvService->appendToCSV(config('app.csv'), $record);
        }

        $response = $this->getJson('/api/clients');

        $response->assertStatus(200);

        $response->assertJsonFragment($responses[0]);
        $response->assertJsonFragment($responses[1]);
    }
}
