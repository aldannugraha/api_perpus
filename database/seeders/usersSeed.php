<?php

namespace Database\Seeders;

use App\Models\users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class usersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'username' => 'testing',
            'password' => Hash::make('123'),
            'nama' => 'Fai',
            'telp' => '085334',
            'alamat' => 'Solo',
            'role' => 'PETUGAS'
        ];

        users::create($data);
    }
}
