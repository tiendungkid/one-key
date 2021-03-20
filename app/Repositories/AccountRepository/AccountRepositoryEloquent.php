<?php


namespace App\Repositories\AccountRepository;


use App\Models\Account;
use App\Repositories\Repository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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

    public function truncate(): bool
    {
        try {
            DB::table('accounts')->delete();
            return true;
        } catch (Exception $exception) {
            logger()->error("Truncate error with message: {$exception->getMessage()}");
            return false;
        }
    }
}
