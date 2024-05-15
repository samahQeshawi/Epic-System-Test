<?php

namespace Database\Seeders;

use App\Models\Design;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Design::create(['name' => 'Design 1',
            'image' => '/storage/public/defult.png',
            'details' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        ]);

        Design::create(['name' => 'Design 2',
            'image' => '/storage/public/defult.png',
            'details' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',

        ]);

        Design::create(['name' => 'Design 3',
            'image' => '/storage/public/defult.png',
            'details' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',

        ]);
    }
}
