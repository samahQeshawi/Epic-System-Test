<?php

namespace Database\Seeders;

use App\Models\Design;
use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create(['name' => 'Package 1',
            'price' => '200',
            'num_invitations' => '250',
            'details' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        ]);

        Package::create(['name' => 'Package 2',
            'price' => '300',
            'num_invitations' => '350',
            'details' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',

        ]);

        Package::create(['name' => 'Package 3',
            'price' => '300',
            'num_invitations' => '350',
            'details' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',

        ]);
    }
}
