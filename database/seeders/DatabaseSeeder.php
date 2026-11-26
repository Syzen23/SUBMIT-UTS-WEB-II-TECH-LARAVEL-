<?php

namespace Database\Seeders;

use App\Models\{Category, Product};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $cupPath = 'products/cupCoffe.png';
        Storage::disk('public')->put($cupPath, file_get_contents(public_path('images/cupCoffe.png')));
        // User::factory(10)->create();

        $categories = collect([
            ['nama_kategori'=>'Produk Unggulan','slug'=>'produk-unggulan'],
            ['nama_kategori'=>'Paket Hemat','slug'=>'paket-hemat'],
            ['nama_kategori'=>'Edisi Spesial','slug'=>'edisi-spesial'],
        ])->mapWithKeys(fn($data) => [$data['slug'] => Category::create($data)]);
        $products = [
            ['produk'=>'Kopi Arabika SeduKopi','kategori'=>'produk-unggulan','harga'=>85000,'deskripsi'=>'Biji kopi Arabika pilihan dengan aroma floral, rasa lembut, dan acidity yang seimbang.'],
            ['produk'=>'Kopi Robusta Nusantara','kategori'=>'produk-unggulan','harga'=>65000,'deskripsi'=>'Roast medium-dark bercita rasa cokelat dan body tebal, cocok untuk espresso maupun tubruk.'],
            ['produk'=>'Paket Ngopi Berdua','kategori'=>'paket-hemat','harga'=>110000,'deskripsi'=>'Dua pilihan kopi favorit SeduKopi dalam satu paket praktis untuk menemani waktu santai.'],
            ['produk'=>'Paket Kopi Kantoran','kategori'=>'paket-hemat','harga'=>145000,'deskripsi'=>'Paket ekonomis berisi kopi bubuk 500 gram untuk menyegarkan momen kerja bersama tim.'],
            ['produk'=>'Kopi Gula Aren','kategori'=>'edisi-spesial','harga'=>32000,'deskripsi'=>'Kopi susu creamy dengan manis alami gula aren, diracik segar untuk pengalaman ngopi kekinian.'],
            ['produk'=>'Cold Brew Signature','kategori'=>'edisi-spesial','harga'=>38000,'deskripsi'=>'Seduhan dingin 18 jam dengan rasa clean dan menyegarkan, ideal diminum kapan saja.'],
        ];
        foreach ($products as $item) Product::create(['category_id'=>$categories[$item['kategori']]->id,'nama_produk'=>$item['produk'],'harga'=>$item['harga'],'deskripsi'=>$item['deskripsi'],'gambar'=>$cupPath]);
    }
}
