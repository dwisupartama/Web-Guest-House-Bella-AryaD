<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'nama_admin' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'alamat_admin' => 'Rahasia',
            'no_telp' => '08123781726',
        ]);
        
        Admin::create([
            'nama_admin' => 'Dwi Supartama',
            'username' => 'dwisupartama',
            'password' => bcrypt('dwisupartama123'),
            'alamat_admin' => 'Jln. Raya Semat',
            'no_telp' => '081228619474',
        ]);
    }
}
