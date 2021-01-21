<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ProfileRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * @OA\Get(
     *      tags={"Profile"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="profile.index",
     *      summary="Profile index",
     *      security={{"token":{}}},
     *      path="/v1/profile",
     *      @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/User"),
     *         )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *      ),
     * ),
     */
    public function index()
    {
        return response()->json(auth()->user());
    }

    /**
     * @OA\Put(
     *      tags={"Profile"},
     *      operationId="profile.update",
     *      summary="Profile update",
     *      security={{"token":{}}},
     *      path="/v1/profile",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/User"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
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
     *         response=422,
     *         description="Validation"
     *     )
     * ),
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->name = $request->name;
        $request->password ? auth()->user()->password = Hash::make($request->password) : null;
        auth()->user()->save();

        return response()->json(auth()->user());
    }
}
