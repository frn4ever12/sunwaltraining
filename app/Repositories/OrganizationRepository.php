<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Repositories\Interfaces\OrganizationRepositoryInterface;

class OrganizationRepository implements OrganizationRepositoryInterface
{

    public function updateOrganization(array $data)
    {
        return Organization::updateOrCreate(
            ['id' => 1],
            $data
        );
    }
}
