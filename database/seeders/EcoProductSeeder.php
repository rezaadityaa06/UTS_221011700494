<?php
namespace Database\Seeders;
use App\Models\EcoProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class EcoProductSeeder extends Seeder
{
    public function run(): void
    {
        // Salinan data sebelum pembaruan, tersimpan lokal di storage/app.
        $backup = 'catalog-backups/eco-products-'.date('Ymd-His').'-'.uniqid().'.json';
        Storage::disk('local')->put($backup, EcoProduct::all()->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        // eco_rating = 4 adalah nilai SIMULASI pembelajaran untuk semua produk.
        // Bukan skor atau sertifikasi dari IKEA; rincian sumber ada di config/catalog_sources.php.
        $products = [
            ['name' => 'KUNGSFORS Tas Jaring Set 2', 'material' => 'Katun 100%', 'price' => 99900, 'eco_rating' => 4, 'image' => 'assets/images/produk-asli/70372836.jpg', 'description' => 'Dua tas jaring berukuran 43 × 32 cm dan 37 × 29 cm untuk membawa belanja atau menyimpan buah dan sayuran. Dapat dicuci untuk dipakai kembali.', 'previous_name' => 'Tas Belanja Kanvas'],
            ['name' => 'ENVÄLDIG Tumbler 350 ml', 'material' => 'Baja tahan karat dan komponen plastik', 'price' => 99900, 'eco_rating' => 4, 'image' => 'assets/images/produk-asli/40511527.jpg', 'description' => 'Tumbler portabel berkapasitas 350 ml untuk membawa minuman panas atau dingin. Pilihan wadah pribadi yang dapat digunakan berulang.', 'previous_name' => 'Tumbler Stainless'],
            ['name' => 'KORKEN Botol Kaca 1 Liter', 'material' => 'Kaca, polipropilena, karet sintetis, baja tahan karat', 'price' => 34900, 'eco_rating' => 4, 'image' => 'assets/images/produk-asli/00213558.jpg', 'description' => 'Botol kaca berkapasitas 1 liter dengan penutup dan pengunci. Dapat digunakan kembali untuk menyajikan serta menyimpan minuman.', 'previous_name' => 'Sikat Gigi Bambu'],
            ['name' => 'KORKEN Stoples Kaca 1 Liter', 'material' => 'Kaca, karet alami, baja tahan karat', 'price' => 39900, 'eco_rating' => 4, 'image' => 'assets/images/produk-asli/30213547.jpg', 'description' => 'Stoples kaca 1 liter dengan penutup berkaret dan pengunci. Cocok untuk menyimpan bahan makanan kering; gasket dicuci dengan tangan.', 'previous_name' => 'Sedotan Stainless Set'],
            ['name' => 'OSTBIT Nampan Bambu 20 × 28 cm', 'material' => 'Bambu, papan serat, venir bambu, lacquer akrilik', 'price' => 74900, 'eco_rating' => 4, 'image' => 'assets/images/produk-asli/30376723.jpg', 'description' => 'Nampan berukuran 20 × 28 cm untuk menyajikan makanan dan minuman. Bersihkan dengan kain lembap sesuai petunjuk perawatan.', 'previous_name' => 'Kotak Makan Bambu'],
            ['name' => 'APTITLIG Talenan Bambu 24 × 15 cm', 'material' => 'Bambu dan minyak', 'price' => 99900, 'eco_rating' => 4, 'image' => 'assets/images/produk-asli/40233427.jpg', 'description' => 'Talenan bambu berukuran 24 × 15 cm untuk persiapan bahan makanan. Cuci dengan tangan dan keringkan setelah digunakan.', 'previous_name' => 'Buku Catatan Daur Ulang'],
            ['name' => 'BLANDA MATT Mangkuk Bambu 28 cm', 'material' => 'Bambu dan lacquer akrilik bening', 'price' => 399000, 'eco_rating' => 4, 'image' => 'assets/images/produk-asli/80214342.jpg', 'description' => 'Mangkuk saji berdiameter 28 cm untuk penggunaan berulang. Cuci dengan tangan; tidak untuk microwave dan hindari alat logam yang menggores permukaan.', 'previous_name' => 'Sabun Batang Herbal'],
            ['name' => 'UPPHETTA Pembuat Kopi/Teh 1 Liter', 'material' => 'Kaca tahan panas, polipropilena, baja tahan karat', 'price' => 179000, 'eco_rating' => 4, 'image' => 'assets/images/produk-asli/40583741.jpg', 'description' => 'Pembuat kopi atau teh berkapasitas 1 liter dengan penyaring tekan. Komponennya dapat dilepas untuk memudahkan pembersihan.', 'previous_name' => 'Kantong Sayur Jaring'],
            ['name' => 'RINNIG Penahan Panas Set 2', 'material' => 'Kain katun 100%; isi poliester (minimum 70% daur ulang)', 'price' => 49900, 'eco_rating' => 4, 'image' => 'assets/images/produk-asli/80476367.jpg', 'description' => 'Sepasang penahan panas berukuran 21 × 21 cm. Isi poliester memiliki kandungan daur ulang minimum 70% menurut keterangan produsen; cuci mengikuti petunjuk perawatan.', 'previous_name' => 'Pot Tanaman Serat Kelapa'],
            ['name' => 'OSTBIT Piring Saji Bambu 42 cm', 'material' => 'Bambu dan minyak', 'price' => 149000, 'eco_rating' => 4, 'image' => 'assets/images/produk-asli/80313323.jpg', 'description' => 'Piring saji bambu berukuran 42 × 16 × 1,6 cm untuk menyajikan makanan. Bersihkan dengan kain lembap dan simpan setelah kering.', 'previous_name' => 'Sendok Garpu Kayu'],
        ];
        DB::transaction(function () use ($products) {
            foreach ($products as $data) {
                $previous = $data['previous_name'];
                unset($data['previous_name']);
                $existing = EcoProduct::where('name', $data['name'])->first();
                $legacy = EcoProduct::where('name', $previous)->first();
                if ($existing && $legacy && $existing->id !== $legacy->id) {
                    throw new \RuntimeException('Ada produk lama dan baru sekaligus. Periksa duplikasi: '.$previous);
                }
                $product = $existing ?? $legacy ?? new EcoProduct();
                $product->fill($data)->save();
            }
        });
        $this->command?->info('10 produk asli diperbarui. Backup data: '.$backup);
    }
}
