<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipeKamar;

class TipeKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipeKamar::create([
            'id' => '1',
            'tipe_kamar' => 'Superior',
        ]);
        
        TipeKamar::create([
            'id' => '2',
            'tipe_kamar' => 'Deluxe',
        ]);
    }
}
