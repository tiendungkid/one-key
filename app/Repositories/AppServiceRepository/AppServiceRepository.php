<?php


namespace App\Repositories\AppServiceRepository;


use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface AppServiceRepository extends RepositoryInterface
{
    /**
     * Paginate with account count
     * @param int $per_page
     * @return LengthAwarePaginator|null
     */
    public function allWithCountAccountCount(int $per_page = 20): ?LengthAwarePaginator;

    /**
     * @param string $query
     * @param int $per_page
     * @return LengthAwarePaginator|null
     */
    public function search(string $query, int $per_page = 20): ?LengthAwarePaginator;

    /**
     * (EMPTY) table
     * @return bool
     */
    public function truncate(): bool;
}
