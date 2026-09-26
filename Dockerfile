# Dockerfile untuk status-web-laravel
# Single-stage dulu (multi-stage baru minggu depan, sesuai materi Pertemuan 05)

FROM php:8.4-cli-alpine

WORKDIR /var/www/html

# Ekstensi PHP yang benar-benar dipakai proyek ini:
#   - pdo + pdo_sqlite -> DB_CONNECTION=sqlite (lihat .env.example)
#   - mbstring         -> wajib dipakai laravel/framework (ext-mbstring)
# Dipasang lewat paket virtual supaya build tools tidak ikut membengkakkan
# image jadi (lihat materi: "Image raksasa" -> selalu bersihkan build deps).
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS sqlite-dev oniguruma-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring \
    && apk del .build-deps \
    && apk add --no-cache sqlite-libs

# Ambil composer langsung dari image resminya, tidak perlu instal manual
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Salin daftar dependensi DULU, sebelum kode aplikasi.
# Selama composer.json & composer.lock tidak berubah, layer "composer install"
# ini dipakai lagi dari cache -> ini poin cache yang harus dibuktikan di tugas.
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist --optimize-autoloader

# Baru salin kode aplikasi. Ini instruksi yang PALING SERING berubah,
# makanya ditaruh paling bawah supaya tidak membatalkan cache di atasnya.
COPY . .

# .env sengaja TIDAK ikut ter-copy (lihat .dockerignore) karena berisi
# kredensial lokal (lihat kesalahan umum #3 di materi: jangan menaruh
# rahasia di dalam image). Di sini kita buat .env baru dari .env.example,
# yang defaultnya sudah DB_CONNECTION=sqlite.
RUN cp .env.example .env \
    && php artisan key:generate --force \
    && touch database/database.sqlite \
    && php artisan migrate --force \
    && php artisan config:clear

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
