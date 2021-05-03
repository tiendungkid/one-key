<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    /**
     * @param array $select
     * @return Collection
     */
    public function getAll(array $select = ['*']): Collection;

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): Model|null;

    /**
     * @param string $column
     * @param mixed $value
     * @return mixed
     */
    public function findBy(string $column, mixed $value): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function findOrFail(int $id): mixed;

    /**
     * @param int $id
     * @param array $relationships
     * @return mixed
     */
    public function findWith(int $id, array $relationships = []): mixed;

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed;

    /**
     * @param array $records
     * @param bool $ignore_error
     * @return int
     */
    public function insert(array $records, bool $ignore_error = true): int;

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param string $select
     * @return Builder
     */
    public function select($select = '*'): Builder;

    /**
     * @param array $condition
     * @return Builder|Model
     */
    public function findByCondition(array $condition): Builder|Model;

    /**
     * @param array $ids
     * @param array $attributes
     * @return int
     */
    public function updateInIds(array $ids, array $attributes): int;

    /**
     * @param array $ids
     * @return int
     */
    public function deleteInIds(array $ids): int;

    /**
     * @param array $maps
     * @param array $attributes
     * @return Model
     */
    public function updateOrCreate(array $maps, array $attributes): Model;

    /**
     * @param array $maps
     * @param array $attributes
     * @return Model
     */
    public function firstOrCreate(array $maps, array $attributes): Model;

    /**
     * Total record of table
     * @return int
     */
    public function countAll(): int;

    /**
     * @param array $conditional
     * @return int
     */
    public function countByConditional(array $conditional): int;
}
