<?php


namespace App\Repositories\AppServiceRepository;


use App\Models\Service;
use App\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceRepositoryEloquent extends Repository implements AppServiceRepository
{

    public function getModel(): string
    {
        return Service::class;
    }

    public function allWithCountAccountCount(int $per_page = 20): ?LengthAwarePaginator
    {
        return $this->model->withCount('accounts')->paginate($per_page);
    }
}
