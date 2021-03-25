<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * The BaseRepositoryContract class
 *
 * @category Repositories
 *
 * @package Model
 *
 * @author Caio Chami <caio.chami@puzl.place>
 *
 * @license PuzlPlace https://www.puzl.place
 *
 * @link https://www.puzl.place*
 */
interface BaseRepositoryContract
{
    /**
     * Begin quering the model
     *
     * @return Builder
     */
    public function query(): Builder;

    /**
     * Find resource by specific field
     *
     * @param string $field
     * @param string $value
     *
     * @return Builder
     */
    public function findByField(
        string $field,
        string $value
    ): Builder;

    /**
     * Retrieve a single resource
     *
     * @param string $id The id of the resource
     *
     * @return Model
     */
    public function show(string $id): Model;

    /**
     * Store a new resource
     *
     * @param array $data The payload
     *
     * @return Model
     */
    public function store(array $data): Model;

    /**
     * Update an existing resource
     *
     * @param array $data The payload
     * @param string $id The id of the resource
     *
     * @return Model
     */
    public function update(array $data, string $id): Model;

    /**
     * Destroy an existing resource
     *
     * @param string $uuid The id of the resource
     *
     * @return int
     */
    public function delete(string $uuid): int;
}
