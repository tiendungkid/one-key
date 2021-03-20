<?php


namespace App\Repositories\AppServiceRepository;


use App\Models\Service;
use App\Repositories\Repository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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

    public function search(string $query, int $per_page = 20): ?LengthAwarePaginator
    {
        return $this->model->where("name", "%{$query}%")->orWhere("home_link", "LIKE", "%{$query}%")
            ->withCount('accounts')
            ->paginate($per_page);
    }

    public function truncate(): bool
    {
        try {
            DB::table('services')->delete();
            return true;
        } catch (Exception $exception) {
            logger()->error("Empty table error with message: {$exception->getMessage()}");
            return false;
        }
    }
}
