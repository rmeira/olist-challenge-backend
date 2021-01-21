<?php

namespace App\Repositories\Contracts;

interface TypeRepositoryInterface
{
    /**
     * Return all resources
     * @return object
     */
    public function all();

    /**
     * Find a resource
     * @param int $id
     * @return object
     */
    public function find($id);

    /**
     * Create a resource
     * @param array $data
     * @return object
     */
    public function create(array $data);

    /**
     * Update a resource
     * @param int $id
     * @param array $data
     * @return object
     */
    public function update($id, array $data);

    /**
     * Delete a resource
     * @param int $id
     * @return boolean
     */
    public function delete($id);
}
