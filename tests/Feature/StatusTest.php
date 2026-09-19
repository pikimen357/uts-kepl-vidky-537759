<?php

namespace Tests\Feature;

use App\Http\Controllers\StatusController;
use Tests\TestCase;

class StatusTest extends TestCase
{
    /**
     * Halaman dashboard harus bisa diakses dan menampilkan judul.
     */
    public function test_status_page_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Dashboard Status Layanan');
    }

    /**
     * getStatusSummary harus menghitung jumlah tiap status dengan benar.
     */
    public function test_get_status_summary_counts_correctly(): void
    {
        $controller = new StatusController();

        $sample = [
            ['name' => 'A', 'status' => 'online'],
            ['name' => 'B', 'status' => 'online'],
            ['name' => 'C', 'status' => 'offline'],
        ];

        $summary = $controller->getStatusSummary($sample);

        $this->assertEquals(2, $summary['online']);
        $this->assertEquals(1, $summary['offline']);
    }
}
