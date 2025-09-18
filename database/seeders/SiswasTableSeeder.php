<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswasTableSeeder extends Seeder
{
    public function run(): void
    {
        // Cari user role siswa
        $user = DB::table('users')->where('id_role', 6)->first();

        if ($user) {
            DB::table('siswas')->insert([
                'id_user'       => $user->id,
                'nis'           => '20250001',
                'nisn'          => '1234567890',
                'nama_lengkap'  => 'Budi',
                'gender'        => 'L',
                'tempat_lahir'  => 'Karanganyar',
                'tanggal_lahir' => '2007-05-15',
                'alamat'        => 'Jl. Pendidikan No. 1',
                'phone'         => '08123456789',
                'email'         => 'budi@example.com',
                'id_kelasindustri' => null,
                'id_kelas'         => 1,
                'id_jurusan'       => 1,
                'angkatan'      => 2025,
                'status'        => 'aktif',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
