<?php

namespace App\Repositories;

use App\Models\InvitationAddress;

class InvitationAddressRepo extends Repository
{
    protected $model;

    public function __construct(InvitationAddress $model) {
        $this->model = $model;
    }

}
