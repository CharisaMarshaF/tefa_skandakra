<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LowongansTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('lowongans')->insert([
            [
                'id_perusahaan' => 1,
                'judul_lowongan' => 'Program Magang RPL 2025',
                'deskripsi' => 'Kesempatan magang untuk siswa jurusan RPL.',
                'gambar' => 'lowongan1.png',
                'tanggal_mulai' => '2025-06-01',
                'tanggal_selesai' => '2025-06-30',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
