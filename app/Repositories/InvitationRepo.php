<?php

namespace App\Repositories;

use App\Models\Invitation;

class InvitationRepo extends Repository
{
    protected $model;

    public function __construct(Invitation $model) {
        $this->model = $model;
    }

    public function getByUserId($userId) {
        return $this->model->where('user_id', $userId)->get();
    }


}
