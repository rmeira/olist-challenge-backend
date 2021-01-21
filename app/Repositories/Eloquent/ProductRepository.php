<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * product model
     *
     * @var Product
     */
    protected $product;

    /**
     * product repository constructor
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Return all product's
     *
     * @return object
     */
    public function all()
    {
        return QueryBuilder::for($this->product)
            ->allowedFilters([...$this->product->getFillable(), AllowedFilter::exact('type_id')])
            ->allowedFields($this->product->getFillable())
            ->allowedSorts($this->product->getFillable())
            ->allowedIncludes($this->product->getRelations())
            ->paginate(empty(request()->query()['limit']) ? 10 : request()->query()['limit'])
            ->appends(request()->query());
    }

    /**
     * Find a product than return
     *
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return QueryBuilder::for($this->product)
            ->allowedFields($this->product->getFillable())
            ->allowedIncludes($this->product->getRelations())
            ->findOrFail($id);
    }

    /**
     * Create a resource
     * @param array $data
     * @return mixed|object
     */
    public function create(array $data)
    {
        $product = new $this->product;
        $product->fill($data);
        $product->save();

        return $product;
    }

    /**
     * Create a new product
     *
     * @param array $data
     * @return object
     */
    public function update($id, array $data)
    {
        $product = $this->product->findOrFail($id);
        $product->fill($data);
        $product->save();

        return $product;
    }

    /**
     * Delete a resource
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->product->findOrFail($id)->delete();
    }

    /**
     * Find a product by email
     *
     * @param string $email
     * @return object
     */
    public function findByEmail($email)
    {
        return $this->product->email($email)->first();
    }
}
