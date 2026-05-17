<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\WasteCategory;
use App\Models\WasteBank;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin WasteWise',
            'email' => 'admin@wastewise.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Categories
        $categories = [
            ['category_name' => 'Organik', 'description' => 'Sampah yang berasal dari sisa makhluk hidup.'],
            ['category_name' => 'Plastik', 'description' => 'Berbagai jenis sampah berbahan plastik.'],
            ['category_name' => 'Kertas', 'description' => 'Sampah berbahan kertas atau karton.'],
            ['category_name' => 'Kaca', 'description' => 'Sampah botol atau beling kaca.'],
            ['category_name' => 'Logam', 'description' => 'Sampah berbahan dasar besi atau aluminium.'],
            ['category_name' => 'Elektronik', 'description' => 'Limbah elektronik atau e-waste.'],
        ];
        foreach ($categories as $cat) {
            WasteCategory::create($cat);
        }

        // Realistic Waste Banks (Around Jakarta and beyond)
        $wasteBanks = [
            [
                'bank_name' => 'Bank Sampah Melati Bersih',
                'address' => 'Jl. Kenangan No 12, Menteng, Jakarta Pusat',
                'latitude' => -6.1963, 'longitude' => 106.8329,
                'operational_hour' => '08:00 - 15:00', 'contact_number' => '0812-3456-7890',
                'rating' => 4.8, 'thumbnail' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=500&q=80',
                'description' => 'Menerima berbagai jenis sampah daur ulang. Pelayanan ramah dan harga tukar kompetitif.',
                'accepted_categories' => json_encode(['Plastik', 'Kertas', 'Logam']),
                'is_open' => true,
            ],
            [
                'bank_name' => 'EcoWaste Hub Sudirman',
                'address' => 'Gedung Eco, SCBD, Jakarta Selatan',
                'latitude' => -6.2272, 'longitude' => 106.8066,
                'operational_hour' => '09:00 - 17:00', 'contact_number' => '021-555-8890',
                'rating' => 5.0, 'thumbnail' => 'https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?w=500&q=80',
                'description' => 'Pusat daur ulang premium di kawasan bisnis. Sangat direkomendasikan untuk e-waste.',
                'accepted_categories' => json_encode(['Elektronik', 'Plastik']),
                'is_open' => true,
            ],
            [
                'bank_name' => 'Sentra Daur Ulang Kemang',
                'address' => 'Jl. Kemang Raya No 45, Jakarta Selatan',
                'latitude' => -6.2625, 'longitude' => 106.8149,
                'operational_hour' => '07:00 - 14:00', 'contact_number' => '0811-222-3333',
                'rating' => 4.5, 'thumbnail' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=500&q=80',
                'description' => 'Fokus pada sampah anorganik rumah tangga.',
                'accepted_categories' => json_encode(['Plastik', 'Kaca']),
                'is_open' => true,
            ],
            [
                'bank_name' => 'GreenLife Center PIK',
                'address' => 'Pantai Indah Kapuk, Jakarta Utara',
                'latitude' => -6.1082, 'longitude' => 106.7384,
                'operational_hour' => '10:00 - 18:00', 'contact_number' => '021-999-1234',
                'rating' => 4.9, 'thumbnail' => 'https://images.unsplash.com/photo-1604187351574-c75ca79f5807?w=500&q=80',
                'description' => 'Pusat pengumpulan limbah ramah lingkungan berteknologi tinggi.',
                'accepted_categories' => json_encode(['Kertas', 'Plastik', 'Logam']),
                'is_open' => true,
            ],
            [
                'bank_name' => 'Bank Sampah Ciliwung',
                'address' => 'Jl. Inspeksi Ciliwung, Tebet, Jakarta Selatan',
                'latitude' => -6.2238, 'longitude' => 106.8530,
                'operational_hour' => '06:00 - 13:00', 'contact_number' => '0857-1111-2222',
                'rating' => 4.3, 'thumbnail' => 'https://images.unsplash.com/photo-1516992654410-9309d4587e94?w=500&q=80',
                'description' => 'Pahlawan kebersihan sungai Ciliwung. Spesialisasi daur ulang plastik botol.',
                'accepted_categories' => json_encode(['Plastik', 'Organik']),
                'is_open' => false,
            ],
            [
                'bank_name' => 'Recycle Me Bintaro',
                'address' => 'Bintaro Sektor 7, Tangerang Selatan',
                'latitude' => -6.2758, 'longitude' => 106.7265,
                'operational_hour' => '08:00 - 16:00', 'contact_number' => '0878-8888-9999',
                'rating' => 4.7, 'thumbnail' => 'https://images.unsplash.com/photo-1528323273322-d81458248d40?w=500&q=80',
                'description' => 'Solusi daur ulang warga Bintaro.',
                'accepted_categories' => json_encode(['Logam', 'Kertas', 'Kaca']),
                'is_open' => true,
            ],
            // 7
            [
                'bank_name' => 'Karya Kita Depok',
                'address' => 'Margonda Raya, Depok',
                'latitude' => -6.3725, 'longitude' => 106.8288,
                'operational_hour' => '08:00 - 15:00', 'contact_number' => '0812-4444-5555',
                'rating' => 4.6, 'thumbnail' => 'https://images.unsplash.com/photo-1563821016766-0a256df9cb4c?w=500&q=80',
                'description' => 'Pusat daur ulang mandiri yang dikelola oleh komunitas mahasiswa.',
                'accepted_categories' => json_encode(['Kertas', 'Elektronik']),
                'is_open' => true,
            ],
            // 8
            [
                'bank_name' => 'E-Waste Hub Bekasi',
                'address' => 'Summarecon Bekasi',
                'latitude' => -6.2235, 'longitude' => 107.0016,
                'operational_hour' => '10:00 - 20:00', 'contact_number' => '021-777-666',
                'rating' => 4.9, 'thumbnail' => 'https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=500&q=80',
                'description' => 'Drop point spesialis untuk sampah elektronik (baterai, HP, laptop bekas).',
                'accepted_categories' => json_encode(['Elektronik']),
                'is_open' => true,
            ],
            // 9
            [
                'bank_name' => 'Bank Sampah Organik Cibubur',
                'address' => 'Kawasan Cibubur Junction',
                'latitude' => -6.3752, 'longitude' => 106.8924,
                'operational_hour' => '07:00 - 12:00', 'contact_number' => '0899-1234-5678',
                'rating' => 4.4, 'thumbnail' => 'https://images.unsplash.com/photo-1591857177580-dc82b9ac4e1e?w=500&q=80',
                'description' => 'Kami mengubah sisa sayur dan makanan menjadi kompos berkualitas.',
                'accepted_categories' => json_encode(['Organik']),
                'is_open' => false,
            ],
            // 10
            [
                'bank_name' => 'Mega Daur Ulang Pluit',
                'address' => 'Pluit Karang Ayu, Jakarta Utara',
                'latitude' => -6.1158, 'longitude' => 106.7865,
                'operational_hour' => '09:00 - 17:00', 'contact_number' => '0815-555-444',
                'rating' => 4.8, 'thumbnail' => 'https://images.unsplash.com/photo-1604187351574-c75ca79f5807?w=500&q=80',
                'description' => 'Menerima daur ulang kertas dan kardus dalam partai besar.',
                'accepted_categories' => json_encode(['Kertas', 'Kaca', 'Plastik']),
                'is_open' => true,
            ]
        ];

        foreach ($wasteBanks as $wb) {
            WasteBank::create($wb);
        }

        // Education Articles
        $articles = [
            [
                'title' => 'Masa Depan Zero Waste Lifestyle: Memulai dari Dapur Anda',
                'content' => 'Gaya hidup minim sampah atau Zero Waste bukan berarti kita harus langsung sempurna pada hari pertama. Mulailah dari hal kecil, seperti mengganti spons cuci piring berbahan plastik dengan loofah (gambas), menggunakan lap kain alih-alih tisu dapur, dan menyimpan sisa makanan dalam wadah kaca yang bisa dipakai ulang. Kompos sisa sayuran Anda. Dalam 30 hari, Anda akan melihat penurunan jumlah sampah rumah tangga hingga 60%.',
                'category' => 'Eco Lifestyle', 'author' => 'Dr. Lestari', 'read_time' => 4,
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800&q=80',
                'is_featured' => true, 'is_trending' => true
            ],
            [
                'title' => 'Mengapa E-Waste Sangat Berbahaya Bagi Air Tanah?',
                'content' => 'Limbah elektronik seperti baterai lama, smartphone mati, dan kabel usang mengandung logam berat seperti timbal, merkuri, dan kadmium. Ketika dibuang ke tempat pembuangan sampah biasa (TPA), logam ini dapat bocor dan meresap ke dalam air tanah yang akhirnya kita konsumsi. Salurkan e-waste Anda ke lembaga tersertifikasi melalui WasteWise untuk diekstraksi kembali material berharganya.',
                'category' => 'Technology', 'author' => 'Andi Wijaya', 'read_time' => 6,
                'image' => 'https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=800&q=80',
                'is_featured' => false, 'is_trending' => true
            ],
            [
                'title' => 'Inovasi Bioplastik dari Singkong: Apakah Benar-benar Mudah Terurai?',
                'content' => 'Kita sering melihat kantong plastik bertuliskan "Cassava Bag" atau plastik singkong. Bioplastik ini memang ramah lingkungan karena terbuat dari bahan organik. Namun, tahukah Anda bahwa mereka tetap membutuhkan kondisi tertentu (suhu dan mikroba spesifik) untuk terurai sempurna? Membuangnya sembarangan di laut tetap membahayakan biota laut. Solusi terbaik tetaplah membawa tas belanja sendiri (Reusable Bag).',
                'category' => 'Innovation', 'author' => 'Siti Nurhaliza', 'read_time' => 5,
                'image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=800&q=80',
                'is_featured' => true, 'is_trending' => false
            ],
            [
                'title' => 'Panduan Membaca Kode Segitiga Daur Ulang pada Plastik',
                'content' => 'Tidak semua plastik diciptakan sama. Kode 1 (PET) seperti botol air mineral sangat mudah didaur ulang. Kode 2 (HDPE) seperti botol sampo juga aman dan bernilai tinggi di bank sampah. Namun, waspadai kode 3 (PVC) dan kode 6 (PS/Styrofoam) karena sangat beracun dan sulit didaur ulang. Selalu cek bagian bawah kemasan sebelum Anda membelinya.',
                'category' => 'Recycling', 'author' => 'WasteWise Team', 'read_time' => 3,
                'image' => 'https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?w=800&q=80',
                'is_featured' => false, 'is_trending' => false
            ],
            [
                'title' => 'Cara Merubah Minyak Jelantah Menjadi Sabun Cuci',
                'content' => 'Minyak jelantah (minyak goreng bekas) sangat fatal jika dibuang ke wastafel karena akan menyumbat saluran dan mencemari jutaan liter air sungai. Solusinya? Anda bisa merubahnya menjadi sabun cuci baju atau sabun cuci piring batangan! Anda hanya membutuhkan soda api (NaOH), air, dan minyak jelantah yang sudah disaring. Ini adalah sirkular ekonomi sejati di rumah Anda.',
                'category' => 'Eco Tips', 'author' => 'Dapur Hijau', 'read_time' => 7,
                'image' => 'https://images.unsplash.com/photo-1516992654410-9309d4587e94?w=800&q=80',
                'is_featured' => false, 'is_trending' => true
            ],
            [
                'title' => 'Mengenal Carbon Footprint: Cara Menghitung Jejak Karbon Anda',
                'content' => 'Jejak karbon adalah total emisi gas rumah kaca yang dihasilkan dari aktivitas kita sehari-hari. Mulai dari listrik yang kita gunakan, transportasi, hingga makanan yang kita konsumsi. Anda dapat mengurangi jejak karbon dengan cara yang sederhana: matikan lampu saat tidak digunakan, gunakan transportasi umum, dan daur ulang sampah Anda. Pengurangan jejak karbon adalah langkah krusial dalam memerangi perubahan iklim.',
                'category' => 'Climate Change', 'author' => 'Global Eco Org', 'read_time' => 5,
                'image' => 'https://images.unsplash.com/photo-1591857177580-dc82b9ac4e1e?w=800&q=80',
                'is_featured' => true, 'is_trending' => false
            ],
            [
                'title' => 'Peran AI dan Computer Vision dalam Sortasi Sampah Global',
                'content' => 'Di era industri 4.0, teknologi Artificial Intelligence (AI) seperti algoritma Convolutional Neural Network (CNN) sedang merombak total industri pengelolaan sampah. Robot yang dilengkapi AI kini mampu memilah sampah plastik dari kertas di konveyor pabrik dengan kecepatan 10x lipat manusia dan akurasi 99%. Teknologi serupa kini telah Anda genggam melalui fitur Smart Scanner di WasteWise!',
                'category' => 'Green Tech', 'author' => 'Budi Santoso, MT.', 'read_time' => 8,
                'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&q=80',
                'is_featured' => true, 'is_trending' => true
            ]
        ];

        foreach ($articles as $art) {
            Article::create($art);
        }
    }
}
