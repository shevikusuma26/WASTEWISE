<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'title' => 'Panduan Lengkap Daur Ulang Plastik di Rumah',
                'content' => 'Plastik adalah salah satu penyumbang sampah terbesar di dunia. Artikel ini membahas cara mendaur ulang plastik mulai dari memisahkan jenis PET, HDPE, hingga memanfaatkannya menjadi pot tanaman atau ecobrick.',
                'category' => 'Edukasi',
                'image_url' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Mengapa E-Waste Sangat Berbahaya bagi Lingkungan?',
                'content' => 'Limbah elektronik (E-Waste) seperti smartphone bekas dan baterai mengandung logam berat beracun seperti timbal dan merkuri. Jika dibuang sembarangan, zat ini dapat mencemari air tanah dan membahayakan kesehatan manusia.',
                'category' => 'Berita',
                'image_url' => 'https://images.unsplash.com/photo-1550989460-0adf9ea622e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Memulai Gaya Hidup Zero Waste dari Dapur Anda',
                'content' => 'Gaya hidup minim sampah bisa dimulai dari dapur. Gunakan kembali sisa sayuran untuk kaldu, buat kompos dari sisa makanan, dan hindari penggunaan plastik sekali pakai saat berbelanja bahan makanan.',
                'category' => 'Edukasi',
                'image_url' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Tren Bank Sampah Digital Meningkat di Tahun 2024',
                'content' => 'Kesadaran masyarakat tentang pengelolaan sampah meningkat drastis seiring dengan hadirnya aplikasi bank sampah digital. Sistem poin dan reward membuat masyarakat lebih antusias dalam memilah sampah.',
                'category' => 'Berita',
                'image_url' => 'https://images.unsplash.com/photo-1604187351574-c75ca79f5807?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Cara Membuat Kompos dari Sampah Organik',
                'content' => 'Langkah-langkah mudah membuat kompos di rumah. Kumpulkan daun kering (coklat) dan sisa sayuran (hijau). Campurkan dengan perbandingan seimbang, jaga kelembapan, dan aduk secara berkala. Dalam 1-2 bulan, kompos siap digunakan.',
                'category' => 'Edukasi',
                'image_url' => 'https://images.unsplash.com/photo-1585241936939-f9c467a3f47e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ]
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
