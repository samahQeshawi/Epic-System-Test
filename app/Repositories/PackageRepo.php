<?php

namespace App\Repositories;

use App\Models\Package;

class PackageRepo extends Repository
{
    protected $model;

    public function __construct(Package $model) {
        $this->model = $model;
    }

}
