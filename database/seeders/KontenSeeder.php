<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Konten;

class KontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Konten::create([
            'id' => '1',
            'judul_konten' => 'Facilities and Service',
            'deskripsi_konten' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus culpa quam perspiciatis. Architecto reprehenderit quod deserunt deleniti molestiae porro officia consectetur. Rerum quis amet voluptates ipsam eos commodi consequuntur eius fuga consequatur, mollitia explicabo quisquam quibusdam fugit quo! Dolor odio ea explicabo perspiciatis sit earum quos pariatur accusamus nemo vero. Obcaecati quidem provident voluptatibus eum cupiditate saepe tenetur sit officia. Fugiat neque veritatis excepturi vitae quas ab molestias officia, nostrum ut autem, porro dolores magnam, rerum eaque corrupti dolor ad fugit necessitatibus at incidunt voluptatibus similique mollitia tenetur harum. Laudantium dignissimos deserunt ratione alias consequatur accusamus nam iure animi illo?.'
        ]);
        
        Konten::create([
            'id' => '2',
            'judul_konten' => 'Accommodation',
            'deskripsi_konten' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus culpa quam perspiciatis. Architecto reprehenderit quod deserunt deleniti molestiae porro officia consectetur. Rerum quis amet voluptates ipsam eos commodi consequuntur eius fuga consequatur, mollitia explicabo quisquam quibusdam fugit quo! Dolor odio ea explicabo perspiciatis sit earum quos pariatur accusamus nemo vero. Obcaecati quidem provident voluptatibus eum cupiditate saepe tenetur sit officia. Fugiat neque veritatis excepturi vitae quas ab molestias officia, nostrum ut autem, porro dolores magnam, rerum eaque corrupti dolor ad fugit necessitatibus at incidunt voluptatibus similique mollitia tenetur harum. Laudantium dignissimos deserunt ratione alias consequatur accusamus nam iure animi illo?.'
        ]);
        
        Konten::create([
            'id' => '3',
            'judul_konten' => 'Beach',
            'deskripsi_konten' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus culpa quam perspiciatis. Architecto reprehenderit quod deserunt deleniti molestiae porro officia consectetur. Rerum quis amet voluptates ipsam eos commodi consequuntur eius fuga consequatur, mollitia explicabo quisquam quibusdam fugit quo! Dolor odio ea explicabo perspiciatis sit earum quos pariatur accusamus nemo vero. Obcaecati quidem provident voluptatibus eum cupiditate saepe tenetur sit officia. Fugiat neque veritatis excepturi vitae quas ab molestias officia, nostrum ut autem, porro dolores magnam, rerum eaque corrupti dolor ad fugit necessitatibus at incidunt voluptatibus similique mollitia tenetur harum. Laudantium dignissimos deserunt ratione alias consequatur accusamus nam iure animi illo?.'
        ]);
    }
}
