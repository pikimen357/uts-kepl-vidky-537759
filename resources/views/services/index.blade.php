<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Status Layanan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Dashboard Status Layanan</h1>
        <p class="subtitle">Pemantauan status layanan secara sederhana</p>
        <a href="{{ route('services.create') }}">+ Tambah Layanan</a>
    </header>

    @if (session('success'))
        <p style="color: green; text-align: center;">{{ session('success') }}</p>
    @endif

    <main id="status-container">
        @forelse ($services as $service)
            <div class="status-card status-{{ $service->status }}">
                <h2>{{ $service->name }}</h2>
                <p>{{ strtoupper($service->status) }}</p>
                <a href="{{ route('services.edit', $service) }}">Edit</a>
                <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus layanan ini?')">Hapus</button>
                </form>
            </div>
        @empty
            <p>Belum ada layanan. Silakan tambah layanan baru.</p>
        @endforelse
    </main>

    <footer>
        <p>Terakhir diperbarui: {{ $lastUpdated }}</p>
    </footer>
</body>
</html>
