<?php


namespace App\Repositories\AccountRepository;


use App\Models\Account;
use App\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;

class AccountRepositoryEloquent extends Repository implements AccountRepository
{

    public function getModel(): string
    {
        return Account::class;
    }

    public function allAccountOfService(int $service_id, int $per_page = 20): ?LengthAwarePaginator
    {
        return $this->model->whereServiceId($service_id)->paginate($per_page);
    }
}
