<?php

namespace Tests\Feature;

use App\Http\Controllers\ServiceController;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_status_page_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Dashboard Status Layanan');
    }

    public function test_get_status_summary_counts_correctly(): void
    {
        $controller = new ServiceController();

        $sample = [
            ['name' => 'A', 'status' => 'online'],
            ['name' => 'B', 'status' => 'online'],
            ['name' => 'C', 'status' => 'offline'],
        ];

        $summary = $controller->getStatusSummary($sample);

        $this->assertEquals(2, $summary['online']);
        $this->assertEquals(1, $summary['offline']);
    }

    public function test_can_create_service(): void
    {
        $response = $this->post('/services', [
            'name' => 'Layanan Baru',
            'status' => 'online',
        ]);

        $response->assertRedirect('/services');
        $this->assertDatabaseHas('services', ['name' => 'Layanan Baru']);
    }

    public function test_can_update_service(): void
    {
        $service = Service::create(['name' => 'Lama', 'status' => 'online']);

        $response = $this->put("/services/{$service->id}", [
            'name' => 'Sudah Diubah',
            'status' => 'offline',
        ]);

        $response->assertRedirect('/services');
        $this->assertDatabaseHas('services', ['name' => 'Sudah Diubah', 'status' => 'offline']);
    }

    public function test_can_delete_service(): void
    {
        $service = Service::create(['name' => 'Akan Dihapus', 'status' => 'online']);

        $response = $this->delete("/services/{$service->id}");

        $response->assertRedirect('/services');
        $this->assertDatabaseMissing('services', ['name' => 'Akan Dihapus']);
    }
}
