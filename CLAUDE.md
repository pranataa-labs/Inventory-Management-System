# Sistem Manajemen Inventaris Enterprise (Shadcn Admin UI)

**Tech Stack:** Laravel 13, Filament v3, Tailwind CSS v4, MySQL / SQLite, Spatie Permission.  
**Standards & Operating Workflow:** Terintegrasi penuh dengan [Workflow Master](.workflow/README.md).

---

## 1. Operating Discipline & Engineering Workflow
Semua pekerjaan rekayasa perangkat lunak pada repositori ini WAJIB mematuhi 9 tahapan alur kerja di `.workflow/workflows/00-engineering-workflow-ai-coding.md`:
1. **Triage:** Pahami tujuan, klasifikasikan tipe tugas dan tingkat risiko (Low / Medium / High).
2. **Discover:** Periksa file terkait, model, migrasi, dan kontrak data sebelum melakukan perubahan.
3. **Design:** Rancang acceptance criteria, flow data, dan boundary error.
4. **Plan:** Tentukan file dan urutan modifikasi; hindari overengineering.
5. **Implement:** Tulis kode bersih, aman, dan modular sesuai konvensi Laravel.
6. **Verify:** Jalankan test suite secara nyata (`php artisan test` atau `./vendor/bin/phpunit`).
7. **Review:** Periksa diff, otorisasi, pencegahan stok minus, dan integritas transaksi.
8. **Release:** Verifikasi migrasi skema dan kesehatan aplikasi.
9. **Report:** Laporkan hasil verifikasi nyata dengan jujur (Passed / Failed / Skipped).

---

## 2. Aturan Domain Khusus Inventaris
- **Pencegahan Stok Minus (Non-Negotiable):** Mutasi stok keluar (`out`, `retur_out`) WAJIB memverifikasi bahwa stok di gudang bersangkutan mencukupi sebelum dikurangi. Jika tidak cukup, sistem melempar exception: `"Stok tidak mencukupi untuk dikeluarkan/retur."`.
- **Integritas Multi-Gudang:** Stok disimpan per kombinasi produk dan gudang pada tabel `product_warehouses`. Atribut `total_stock` pada model `Product` merupakan penjumlahan seluruh gudang.
- **Audit Logging:** Setiap mutasi atau perubahan master data dicatat melalui trait `HasAuditLog`.
- **Testing (Pola AAA):** Pengujian automated wajib menggunakan SQLite in-memory (`RefreshDatabase`), mengikuti standar `.workflow/rules/04-testing-qa-rules.md`.
