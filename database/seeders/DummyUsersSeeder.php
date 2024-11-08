<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=>'Administrator',
                'email'=>'admin@gmail.com',
                'role'=>'administrator',
                'password'=>bcrypt('admin123')
            ],
            [
                'name'=>'Petugas',
                'email'=>'petugas@gmail.com',
                'role'=>'petugas',
                'password'=>bcrypt('petugas123')
            ],
            [
                'name'=>'Pimpinan',
                'email'=>'pimpinan@gmail.com',
                'role'=>'pimpinan',
                'password'=>bcrypt('pimpinan123')
            ],
        ];

        foreach($userData as $key => $val) {
            User::create($val);
        }
    }
}
