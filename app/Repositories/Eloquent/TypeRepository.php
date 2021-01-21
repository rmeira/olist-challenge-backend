<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\TypeRepositoryInterface;
use App\Models\Type;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TypeRepository implements TypeRepositoryInterface
{
    /**
     * type model
     *
     * @var Type
     */
    protected $type;

    /**
     * type repository constructor
     *
     * @param Type $type
     */
    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    /**
     * Return all type's
     *
     * @return object
     */
    public function all()
    {
        return QueryBuilder::for($this->type)
            ->allowedFilters($this->type->getFillable())
            ->allowedFields($this->type->getFillable())
            ->allowedSorts($this->type->getFillable())
            ->allowedIncludes($this->type->getRelations())
            ->paginate(empty(request()->query()['limit']) ? 10 : request()->query()['limit'])
            ->appends(request()->query());
    }

    /**
     * Find a type than return
     *
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return QueryBuilder::for($this->type)
            ->allowedFields($this->type->getFillable())
            ->allowedIncludes($this->type->getRelations())
            ->findOrFail($id);
    }

    /**
     * Create a resource
     * @param array $data
     * @return mixed|object
     */
    public function create(array $data)
    {
        $type = new $this->type;
        $type->fill($data);
        $type->save();

        return $type;
    }

    /**
     * Create a new type
     *
     * @param array $data
     * @return object
     */
    public function update($id, array $data)
    {
        $type = $this->type->findOrFail($id);
        $type->fill($data);
        $type->save();

        return $type;
    }

    /**
     * Delete a resource
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->type->findOrFail($id)->delete();
    }

    /**
     * Find a type by email
     *
     * @param string $email
     * @return object
     */
    public function findByEmail($email)
    {
        return $this->type->email($email)->first();
    }
}
