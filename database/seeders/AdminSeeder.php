<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $admin = User::where('mobile','09357154806')->first();
        if (!$admin){
            User::create([
                'mobile' => '09357154806',
                'first_name' => 'vahid',
                'last_name' => 'pirian',
                'activation' => 1,
                'activation_date' => now(),
                'status' => 1,
                'user_type' => 1,
                'password' => Hash::make('123456'),
            ]);
        }
    }
}
