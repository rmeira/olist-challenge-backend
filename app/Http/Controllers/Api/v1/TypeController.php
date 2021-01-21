<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\TypeRequest;
use App\Repositories\Contracts\TypeRepositoryInterface;
use Illuminate\Routing\Controller;

class TypeController extends Controller
{
    /**
     * Object model
     *
     * @var object
     */
    protected $type;

    /**
     * Construction function
     *
     * @param TypeRepositoryInterface $type
     */
    public function __construct(TypeRepositoryInterface $type)
    {
        $this->type = $type;
    }

    /**
     * @OA\Get(
     *      tags={"Type"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="types.index",
     *      summary="Type index",
     *      security={{"token":{}}},
     *      path="/v1/types",
     *      @OA\Parameter(
     *         in="query",
     *         name="filter[name]",
     *         parameter="filter[name]",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *         in="query",
     *         name="include",
     *         parameter="include",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="fields[types]",
     *         parameter="fields[types]",
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
     *              @OA\Schema(ref="#/components/schemas/Type"),
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
        return response()->json($this->type->all());
    }

    /**
     * @OA\Post(
     *      tags={"Type"},
     *      operationId="types.create",
     *      summary="Type create",
     *      security={{"token":{}}},
     *      path="/v1/types",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Type"),
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Type"),
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
    public function store(TypeRequest $request)
    {
        return response()->json($this->type->create($request->all()));
    }

    /**
     * @OA\Get(
     *      tags={"Type"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="types.show",
     *      summary="Type show",
     *      security={{"token":{}}},
     *      path="/v1/types/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
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
     *              @OA\Schema(ref="#/components/schemas/Type"),
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
        return response()->json($this->type->find($id));
    }

    /**
     * @OA\Put(
     *      tags={"Type"},
     *      operationId="types.update",
     *      summary="Type update",
     *      security={{"token":{}}},
     *      path="/v1/types/{id}",
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
     *              @OA\Schema(ref="#/components/schemas/Type"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     * ),
     */
    public function update(TypeRequest $request, $id)
    {
        return response()->json($this->type->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *      tags={"Type"},
     *      operationId="types.destroy",
     *      summary="Type destroy",
     *      security={{"token":{}}},
     *      path="/v1/types/{id}",
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
        return response()->json($this->type->delete($id));
    }
}
