<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Category 1: Handmade
            [
                'name' => 'Tas Handmade Kulit Asli',
                'image' => 'https://res.cloudinary.com/dfa5oe9qp/image/upload/v1735750423/banyumkm/e2fi9ppjg6ioby6ibfyk.jpg',
                'description' => 'Tas berkualitas tinggi dari kulit asli buatan UMKM Banyumas.',
                'price' => 350000,
                'category_id' => 1,
            ],
            [
                'name' => 'Dompet Rajut Handmade',
                'image' => 'https://res.cloudinary.com/dfa5oe9qp/image/upload/v1735750424/banyumkm/h9rnopt4e2ylhl8iqgp4.jpg',
                'description' => 'Dompet cantik hasil rajutan tangan UMKM lokal.',
                'price' => 75000,
                'category_id' => 1,
            ],

            // Category 2: Kerajinan Tangan
            [
                'name' => 'Patung Kayu Ukir',
                'image' => 'https://res.cloudinary.com/dfa5oe9qp/image/upload/v1735750424/banyumkm/kwbutnihnarnqofxnr6c.jpg',
                'description' => 'Kerajinan tangan berupa patung kayu ukir yang indah.',
                'price' => 150000,
                'category_id' => 2,
            ],
            [
                'name' => 'Keranjang Anyaman Bambu',
                'image' => 'https://res.cloudinary.com/dfa5oe9qp/image/upload/v1735750422/banyumkm/nfqkriziq4maklkcsjwj.jpg',
                'description' => 'Kerajinan tangan berupa keranjang anyaman dari bambu.',
                'price' => 50000,
                'category_id' => 2,
            ],

            // Category 3: Karya Seni
            [
                'name' => 'Lukisan Pemandangan',
                'image' => 'https://res.cloudinary.com/dfa5oe9qp/image/upload/v1735750422/banyumkm/s9zs3ecudpzuhgw6bp9v.jpg',
                'description' => 'Karya seni lukisan pemandangan alam Banyumas.',
                'price' => 500000,
                'category_id' => 3,
            ],
            [
                'name' => 'Kaligrafi Islami',
                'image' => 'https://res.cloudinary.com/dfa5oe9qp/image/upload/v1735750422/banyumkm/uh3fojojwp2yi8xpecn2.jpg',
                'description' => 'Karya seni kaligrafi dengan sentuhan modern.',
                'price' => 300000,
                'category_id' => 3,
            ],

            // Category 4: Produk Unik
            [
                'name' => 'Produk Unik Botol Hias',
                'image' => 'https://res.cloudinary.com/dfa5oe9qp/image/upload/v1735750422/banyumkm/jsmb1sr7zeh9sinux4jx.jpg',
                'description' => 'Produk unik berupa botol hias dengan desain menarik.',
                'price' => 75000,
                'category_id' => 4,
            ],
            [
                'name' => 'Lampu Meja dari Barang Bekas',
                'image' => 'https://res.cloudinary.com/dfa5oe9qp/image/upload/v1735750422/banyumkm/vkycz2qpdacdvtwzckvq.jpg',
                'description' => 'Produk unik berupa lampu meja yang terbuat dari barang bekas.',
                'price' => 125000,
                'category_id' => 4,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
