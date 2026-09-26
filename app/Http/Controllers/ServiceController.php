<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Fungsi murni: menghitung ringkasan jumlah status.
     * Dipisah dari query agar mudah di-unit test.
     */
    public function getStatusSummary(iterable $services): array
    {
        $summary = [];

        foreach ($services as $service) {
            $status = is_array($service) ? $service['status'] : $service->status;
            $summary[$status] = ($summary[$status] ?? 0) + 1;
        }

        return $summary;
    }

    public function index()
    {
        $services = Service::latest()->get();

        return view('services.index', [
            'services' => $services,
            'summary' => $this->getStatusSummary($services),
            'lastUpdated' => now()->translatedFormat('d M Y H:i:s'),
        ]);
    }


    public function indexApi()
    {
        $services = Service::latest()->get();

        return response()->json([
            'success' => true,
            'services' => $services,
            'summary' => $this->getStatusSummary($services),
            'lastUpdated' => now()->translatedFormat('d M Y H:i:s'),
        ]);
    }

    public function show(Service $service)
    {
        return response()->json([
            'success' => true,
            'data' => $service,
        ]);
    }
//    Baris comment ditambahkan

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:online,offline,maintenance',
        ]);

        Service::create($validated);

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', ['service' => $service]);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:online,offline,maintenance',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
