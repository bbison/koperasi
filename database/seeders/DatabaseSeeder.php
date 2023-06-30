<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Bagas',
            'password'=>bcrypt('1234'),
            'bagian'=>'ADMINISTRATOR',
            'alamat'=>'Ungaran',
            'hak_akses'=>'ADMINISTRATOR'
        ]);
        \App\Models\profil::create([
            'nama_koperasi'=>'Nama Koperasi',
            'logo'=>'koperasi-1.png',
            'alamat'=>'alamat',
            'telepon'=>'telepon',
            'ketua'=>'ketua',
            'wakil_ketua'=>'wakil_ketua',
            'sekertaris'=>'sekertaris',
            'bendahara'=>'bendahara',
        ]);

        //seed bunga
        \App\Models\bunga_pinjaman::create([
            'bunga'=>8
        ]);
        \App\Models\bunga_pinjaman::create([
            'bunga'=>6
        ]);
        \App\Models\bunga_pinjaman::create([
            'bunga'=>5
        ]);

        //jenis_pinjaman
        \App\Models\jenis_pinjaman::create([
            'jenis_pinjaman'=>'Putang Staff',
            'kode'=>'1.1.3',
        ]);
        \App\Models\jenis_pinjaman::create([
            'jenis_pinjaman'=>'Putang Produksi',
            'kode'=>'1.1.2',
        ]);
        \App\Models\jenis_pinjaman::create([
            'jenis_pinjaman'=>'Putang Kacamata',
            'kode'=>'1.1.2',
        ]);
        \App\Models\jenis_pinjaman::create([
            'jenis_pinjaman'=>'Piutang Belum Terbayar',
            'kode'=>'1.1.4',
        ]);
        \App\Models\jenis_pinjaman::create([
            'jenis_pinjaman'=>'Hutang Lainya',
            'kode'=>'1.1.3',
        ]);
        //lama pinjaman
        \App\Models\lama_pinjam::create([
            'lama'=>1
        ]);
        \App\Models\lama_pinjam::create([
            'lama'=>2
        ]);
        \App\Models\lama_pinjam::create([
            'lama'=>3
        ]);
        \App\Models\lama_pinjam::create([
            'lama'=>4
        ]);
        \App\Models\lama_pinjam::create([
            'lama'=>5
        ]);
        \App\Models\lama_pinjam::create([
            'lama'=>6
        ]);
        \App\Models\lama_pinjam::create([
            'lama'=>7
        ]);
        \App\Models\lama_pinjam::create([
            'lama'=>8
        ]);
        \App\Models\lama_pinjam::create([
            'lama'=>9
        ]);
        \App\Models\lama_pinjam::create([
            'lama'=>10
        ]);
        \App\Models\lama_pinjam::create([
            'lama'=>11
        ]);
        \App\Models\lama_pinjam::create([
            'lama'=>12
        ]);
        \App\Models\akun::create([
            'nama_akun'=>'Kas',
            'no_akun'=>'1.1.1'
        ]);
        \App\Models\akun::create([
            'nama_akun'=>'Biaya Operasional',
            'no_akun'=>'5.5.1.001'
        ]);
        \App\Models\akun::create([
            'nama_akun'=>'Biaya Pembulatan',
            'no_akun'=>'5.5.1.002'
        ]);







    }
}
