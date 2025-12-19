<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'sekumam'],
            [
            'name' => 'Sekretaris Umum',
            'password' => Hash::make('sekum123'),
            'role' => 'admin'
            ]
        );


        User::updateOrCreate(
            ['username' => 'sekbidam'],
            [
            'name' => 'Sekretaris Bidang',
            'password' => Hash::make('sekbid123'),
            'role' => 'user'
            ]
        );
    }
}
