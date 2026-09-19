<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create(['name' => 'Website', 'status' => 'online']);
        Service::create(['name' => 'API Server', 'status' => 'online']);
        Service::create(['name' => 'Database', 'status' => 'offline']);
        Service::create(['name' => 'Payment Gateway', 'status' => 'maintenance']);
    }
}
