<?php


namespace App\Repositories\AccountRepository;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface AccountRepository extends RepositoryInterface
{
    /**
     * @param int $service_id
     * @param int $per_page
     * @return LengthAwarePaginator|null
     */
    public function allAccountOfService(int $service_id, int $per_page = 20): ?LengthAwarePaginator;

    /**
     * (EMPTY) table
     * @return bool
     */
    public function truncate(): bool;
}
