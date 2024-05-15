<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Design;
use App\Models\Invitation;
use App\Models\InvitationType;
use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create(['name' => 'خصم بمناسبة عيد الاضحى المبارك' ,
                         'code' => '2222' ,
                         'start' => '2023-06-20' ,
                         'end' => '2023-06-30' ,
                         'discount' => '20' ,
                         'status' => 'active' ,
            ]);

        Coupon::create(['name' => 'خصم العيد' ,
            'code' => '4444' ,
            'start' => '2023-06-10' ,
            'end' => '2023-06-20' ,
            'discount' => '20' ,
            'status' => 'active' ,
        ]);

    }
}
