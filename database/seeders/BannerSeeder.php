<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::create(['name' => 'banner 1',
                        'link' => 'https://www.youtube.com/watch?v=5TiXsRoQac8',
                        'image' => '/storage/public/defult.png',
            ]);

        Banner::create(['name' => 'banner 2',
            'link' => 'https://www.youtube.com/watch?v=5TiXsRoQac8',
            'image' => '/storage/public/defult.png',
        ]);

        Banner::create(['name' => 'banner 3',
            'link' => 'https://www.youtube.com/watch?v=5TiXsRoQac8',
            'image' => '/storage/public/defult.png',
        ]);
    }
}
