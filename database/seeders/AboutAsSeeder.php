<?php

namespace Database\Seeders;

use App\Models\AboutAs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutAsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutAs::create(['title' => 'لماذا مراسيم؟',
            'image' => '/storage/public/defult.png',

        ]);
        AboutAs::create(['title' => 'الية عمل مراسيم؟',
            'image' => '/storage/public/defult.png',

        ]);

    }
}
