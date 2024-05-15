<?php

namespace Database\Seeders;

use App\Models\Design;
use App\Models\Invitation;
use App\Models\InvitationType;
use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesInvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvitationType::create(['name' => 'زواج']);
        InvitationType::create(['name' => 'خطوبة']);
        InvitationType::create(['name' => 'تخرج']);
        InvitationType::create(['name' => 'مؤتمر' ]);
    }
}
