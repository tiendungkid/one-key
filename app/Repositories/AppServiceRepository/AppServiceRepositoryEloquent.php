<?php


namespace App\Repositories\AppServiceRepository;


use App\Models\Service;
use App\Repositories\Repository;

class AppServiceRepositoryEloquent extends Repository implements AppServiceRepository
{

    public function getModel(): string
    {
        return Service::class;
    }
}
