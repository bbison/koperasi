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

        // \App\Models\pembagian_shu::create([
        //     'user_id'=>1,
        //     'shu_id'=>1,
        //     'nama'=>'bagas',
        //     'nominal'=>10000
        // ]);
    }
}
