<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'asal_negara' => 'Indonesia',
            'no_telp' => '08123781726',
        ]);
    }
}
