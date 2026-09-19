<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Layanan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Edit Layanan</h1>
    </header>

    <main>
        @if ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Nama Layanan</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $service->name) }}" required><br><br>

            <label for="status">Status</label><br>
            <select id="status" name="status" required>
                <option value="online" {{ $service->status == 'online' ? 'selected' : '' }}>Online</option>
                <option value="offline" {{ $service->status == 'offline' ? 'selected' : '' }}>Offline</option>
                <option value="maintenance" {{ $service->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select><br><br>

            <button type="submit">Simpan Perubahan</button>
            <a href="{{ route('services.index') }}">Batal</a>
        </form>
    </main>
</body>
</html>
