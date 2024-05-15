<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rating::create(['user_id' => '1',
            'rate' => '4',
            'status' => 'active',
            'comment' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',

        ]);
        Rating::create(['user_id' => '2',
            'rate' => '5',
            'comment' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',

        ]);
    }
}
