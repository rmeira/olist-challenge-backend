<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    /**
     * Object model
     *
     * @var object
     */
    protected $user;

    /**
     * Construction function
     *
     * @param UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @OA\Get(
     *      tags={"User"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="users.index",
     *      summary="User index",
     *      security={{"token":{}}},
     *      path="/v1/users",
     *      @OA\Parameter(
     *         in="query",
     *         name="filter[name]",
     *         parameter="filter[name]",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *         in="query",
     *         name="filter[email]",
     *         parameter="filter[email]",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="fields[users]=id,name",
     *         parameter="fields[users]=id,name",
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
     *              @OA\Schema(ref="#/components/schemas/User"),
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
        return response()->json($this->user->all());
    }

    /**
     * @OA\Post(
     *      tags={"User"},
     *      operationId="users.create",
     *      summary="User create",
     *      security={{"token":{}}},
     *      path="/v1/users",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/User"),
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/User"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="User does not have the right permission"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error. The given data was invalid."
     *     ),
     * ),
     */
    public function store(UserStoreRequest $request)
    {
        return response()->json($this->user->create($request->all()));
    }

    /**
     * @OA\Get(
     *      tags={"User"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="users.show",
     *      summary="User show",
     *      security={{"token":{}}},
     *      path="/v1/users/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the user",
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
     *              @OA\Schema(ref="#/components/schemas/User"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="User does not have the right permission"
     *     ),
     * ),
     */
    public function show($id)
    {
        return response()->json($this->user->find($id));
    }

    /**
     * @OA\Put(
     *      tags={"User"},
     *      operationId="users.update",
     *      summary="User update",
     *      security={{"token":{}}},
     *      path="/v1/users/{id}",
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
     *              @OA\Schema(ref="#/components/schemas/User"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="User does not have the right users"
     *     )
     * ),
     */
    public function update(UserUpdateRequest $request, $id)
    {
        return response()->json($this->user->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *      tags={"User"},
     *      operationId="users.destroy",
     *      summary="User destroy",
     *      security={{"token":{}}},
     *      path="/v1/users/{id}",
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
     *     @OA\Response(
     *         response=403,
     *         description="User does not have the right permission"
     *     )
     * ),
     */
    public function destroy($id)
    {
        return response()->json($this->user->delete($id));
    }
}
