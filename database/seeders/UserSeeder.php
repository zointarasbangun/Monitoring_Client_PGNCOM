<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'  =>'Zointa ras bangun',
            'email' => 'zointa.120140225@student.itera.ac.id',
            'password' => Hash::make('Zoin2002!'),
        ]);

    }
}
