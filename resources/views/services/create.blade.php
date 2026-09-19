<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Layanan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Tambah Layanan Baru</h1>
    </header>

    <main>
        @if ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('services.store') }}" method="POST">
            @csrf

            <label for="name">Nama Layanan</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required><br><br>

            <label for="status">Status</label><br>
            <select id="status" name="status" required>
                <option value="online" {{ old('status') == 'online' ? 'selected' : '' }}>Online</option>
                <option value="offline" {{ old('status') == 'offline' ? 'selected' : '' }}>Offline</option>
                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select><br><br>

            <button type="submit">Simpan</button>
            <a href="{{ route('services.index') }}">Batal</a>
        </form>
    </main>
</body>
</html>
