<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ProductRequest;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    /**
     * Object model
     *
     * @var object
     */
    protected $product;

    /**
     * Construction function
     *
     * @param ProductRepositoryInterface $product
     */
    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    /**
     * @OA\Get(
     *      tags={"Product"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="products.index",
     *      summary="Product index",
     *      security={{"token":{}}},
     *      path="/v1/products",
     *      @OA\Parameter(
     *         in="query",
     *         name="filter[name]",
     *         parameter="filter[name]",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *         in="query",
     *         name="filter[type_id]",
     *         parameter="filter[type_id]",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="filter[value]",
     *         parameter="filter[value]",
     *         @OA\Schema(type="float")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="fields[products]",
     *         parameter="fields[products]",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="include",
     *         parameter="include",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="sort",
     *         parameter="sort",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="page",
     *         parameter="page",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="limit",
     *         parameter="limit",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Product"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     )
     * ),
     */
    public function index()
    {
        return response()->json($this->product->all());
    }

    /**
     * @OA\Post(
     *      tags={"Product"},
     *      operationId="products.create",
     *      summary="Product create",
     *      security={{"token":{}}},
     *      path="/v1/products",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Product"),
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Product"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error. The given data was invalid."
     *     ),
     * ),
     */
    public function store(ProductRequest $request)
    {
        return response()->json($this->product->create($request->all()));
    }

    /**
     * @OA\Get(
     *      tags={"Product"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="products.show",
     *      summary="Product show",
     *      security={{"token":{}}},
     *      path="/v1/products/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="include",
     *         parameter="include",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="fields",
     *         parameter="fields",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Product"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     * ),
     */
    public function show($id)
    {
        return response()->json($this->product->find($id));
    }

    /**
     * @OA\Put(
     *      tags={"Product"},
     *      operationId="products.update",
     *      summary="Product update",
     *      security={{"token":{}}},
     *      path="/v1/products/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Product"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     * ),
     */
    public function update(ProductRequest $request, $id)
    {
        return response()->json($this->product->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *      tags={"Product"},
     *      operationId="products.destroy",
     *      summary="Product destroy",
     *      security={{"token":{}}},
     *      path="/v1/products/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *         )
     *      ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *    				 @OA\Property(
     *                      property="boolean",
     *    					type="boolean",
     *    					example="true",
     *    				),
     *    			),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     * ),
     */
    public function destroy($id)
    {
        return response()->json($this->product->delete($id));
    }
}
