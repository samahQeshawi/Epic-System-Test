<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Models\InvitationAddress;

class CouponRepo extends Repository
{
    protected $model;

    public function __construct(Coupon $model) {
        $this->model = $model;
    }

}
