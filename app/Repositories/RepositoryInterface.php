<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{

    /**
     * Get all
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id): mixed;

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []): mixed;

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []): mixed;

    /**
     * Delete
     * @param $id
     * @return bool
     */
    public function delete($id): bool;

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

    /**
     * @param array $conditional
     * @param array $attributes
     * @return mixed
     */
    public function firstOrCreate(array $conditional, array $attributes): mixed;

    /**
     * @param array $conditional
     * @return mixed
     */
    public function findByConditional(array $conditional): mixed;

    /**
     * @param array $records
     * @param bool $ignore_error
     * @return bool
     */
    public function insert(array $records, bool $ignore_error = true): bool;

    /**
     * @param array $conditional
     * @param $attributes
     * @return bool
     */
    public function updateOrCreate(array $conditional, $attributes): bool;

    /**
     *
     * @param array $ids
     * @param array $attributes
     * @return int
     */
    public function updateInIds(array $ids, array $attributes): int;

    /**
     * @param array $ids
     * @return bool
     */
    public function deleteInIds(array $ids): bool;
}
