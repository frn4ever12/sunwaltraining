<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
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
        $user=User::create([
            'name'=>'Super Admin',
            'email'=>'developersgroup2025@gmail.com',
            'password'=>Hash::make('Admin@123'),
            'email_verified_at'=>Carbon::now()
        ]);
        $user->assignRole('super-admin');
    }
}
