<?php


namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{
    protected mixed $model;

    /**
     * BaseRepository constructor.
     * Set model
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * @return Model
     */
    abstract public function getModel(): string;

    /**
     * Set Model
     */
    public function setModel()
    {
        $this->model = app($this->getModel());
    }

    public function getAll(array $select = ['*']): Collection
    {
        return $this->model::all($select);
    }

    public function findOrFail(int $id): mixed
    {
        return $this->model->findOrFail($id);
    }

    public function find(int $id): Model|null
    {
        return $this->model->find($id);
    }

    public function findBy(string $column, mixed $value): mixed
    {
        return $this->model->where($column, '=', $value)->first();
    }

    public function findWith(int $id, array $relationships = []): mixed
    {
        return $this->model->whereId($id)->with($relationships)->first();
    }

    public function create(array $attributes): mixed
    {
        return $this->model->create($attributes);
    }

    public function insert(array $records, bool $ignore_error = true): int
    {
        try {
            if ($ignore_error) return $this->model->insertOrIgnore($records);
            return (int)$this->model->insert($records);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return 0;
        }
    }

    public function update(int $id, array $attributes): bool
    {
        $record = $this->find($id);
        if (!$record) return false;
        return (bool)$record->update($attributes);
    }

    public function delete(int $id): bool
    {
        $record = $this->find($id);
        if (!$record) return false;
        try {
            return (bool)$record->delete();
        } catch (Exception) {
            return false;
        }
    }

    public function select($select = '*'): Builder
    {
        return $this->model->select($select);
    }

    public function findByCondition(array $condition): Builder|Model
    {
        return $this->model->where($condition)->first();
    }

    public function updateInIds(array $ids, array $attributes): int
    {

        return $this->model->whereIn('id', $ids)->update($attributes);
    }

    public function deleteInIds(array $ids): int
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    public function updateOrCreate(array $maps, array $attributes): Model
    {
        return $this->model->updateOrCreate($maps, $attributes);
    }

    public function firstOrCreate(array $maps, array $attributes): Model
    {
        return $this->model->firstOrCreate($maps, $attributes);
    }

    public function countAll(): int
    {
        return $this->countByConditional([]);
    }

    public function countByConditional(array $conditional): int
    {
        return $this->model->where($conditional)->count();
    }
}
