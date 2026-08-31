# Dashboard Status Layanan

Aplikasi web sederhana untuk menampilkan status beberapa layanan (online, offline, maintenance) dalam bentuk dashboard.

## Fitur

- Menampilkan daftar layanan beserta statusnya dalam bentuk kartu berwarna
- Menampilkan waktu terakhir diperbarui
- (branch `feature/auto-refresh`) Status diperbarui otomatis setiap beberapa detik

## Cara Menjalankan

Buka `index.html` langsung di browser, atau jalankan dengan live server apa pun.

## Testing

Project ini memiliki unit test sederhana untuk fungsi logika (`getStatusSummary`):

```bash
node test.js
```

## CI/CD

Setiap push dan pull request ke `main` akan menjalankan GitHub Actions:
- **lint-html**: memvalidasi struktur `index.html`
- **test-js**: menjalankan unit test `test.js`
