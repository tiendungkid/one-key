<?php


namespace App\Repositories;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Repository implements RepositoryInterface
{
    protected mixed $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel(): string;

    public function setModel()
    {
        try {
            $this->model = app()->make($this->getModel());
        } catch (BindingResolutionException $e) {
            logger()->error("> Set model error (Binding) {$e->getMessage()}");
        }
    }

    public function all(array $selects): Collection
    {
        return $this->model::all($selects);
    }

    public function find($id): mixed
    {
        return $this->model->find($id);
    }

    public function create($attributes = []): mixed
    {
        try {
            return $this->model->create($attributes);
        } catch (Exception) {
            return false;
        }
    }

    public function update($id, $attributes = []): mixed
    {
        $record = $this->find($id);
        if (!$record) return false;
        try {
            return $record->update($attributes);
        } catch (Exception) {
            return false;
        }
    }

    public function delete($id): bool
    {
        $record = $this->find($id);
        if (!$record) return false;
        try {
            return $record->delete();
        } catch (Exception) {
            return false;
        }
    }

    public function countAll(): int
    {
        return $this->countByConditional([]);
    }

    public function countByConditional(array $conditional): int
    {
        return $this->model->where($conditional)->count();
    }

    public function firstOrCreate(array $conditional, array $attributes): mixed
    {
        return $this->model->firstOrCreate($conditional, $attributes);
    }

    public function findByConditional(array $conditional): mixed
    {
        return $this->model->where($conditional)->first();
    }

    public function insert(array $records, bool $ignore_error = true): int
    {
        try {
            if ($ignore_error) return $this->model->insertOrIgnore($records);
            return (int)$this->model->insert($records);
        } catch (Exception) {
            return 0;
        }
    }

    public function updateOrCreate(array $conditional, $attributes): bool
    {
        try {
            return $this->model->where($conditional)->update($attributes);
        } catch (Exception) {
            return false;
        }
    }

    public function updateInIds(array $ids, array $attributes): int
    {
        return $this->model->whereId($ids)->update($attributes);
    }

    public function deleteInIds(array $ids): bool
    {
        try {
            return $this->model->whereId($ids)->delete();
        } catch (Exception) {
            return false;
        }
    }

    public function allWithPaginate(int $limit): ?LengthAwarePaginator
    {
        return $this->model->paginate($limit);
    }
}
