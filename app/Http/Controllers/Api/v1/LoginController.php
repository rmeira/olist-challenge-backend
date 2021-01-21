<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\LoginRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * User repository
     *
     * @var UserRepositoryInterface
     */
    protected $user;

    /**
     * LoginController constructor.
     * @param UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }


    /**
     * @OA\Info(
     *  title="Olist Challenge",
     *  version="1",
     *  @OA\Contact(
     *      name="Rafael Meira",
     *      email="rafaelmeira@me.com"
     *   )
     * ),
     * @OA\Server(
     *      url="localhost",
     *      description="localhost"
     * ),
     * @OA\Schemes(format="http")
     * @OA\SecurityScheme(
     *      securityScheme="token",
     *      in="header",
     *      name="token",
     *      type="http",
     *      scheme="bearer",
     *      bearerFormat="JWT",
     * ),
     */
    /**
     *  @OA\Post(
     *     path="/v1/auth/login",
     *     tags={"Auth"},
     *     summary="Auth login",
     *     operationId="auth.login",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              type="Accept",
     *              mediaType="application/json",
     *              @OA\Schema(
     *    				 @OA\Property(
     *                      property="email",
     *    					type="string",
     *    					example="admin@olistchallenge.com.br",
     *    					description="Email"
     *    				),
     *    				 @OA\Property(
     *                      property="password",
     *    					type="string",
     *    					example="****",
     *    					description="Password"
     *    				),
     *    			),
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *    		@OA\MediaType(
     *    			mediaType="application/json",
     *    			@OA\Schema(
     *    				 @OA\Property(property="token",
     *    					type="string",
     *    					example="eyJ0eXAiOiJKV1QiLCJhbG...",
     *    					description="Token"
     *    				),
     *    				 @OA\Property(property="token_type",
     *    					type="string",
     *    					example="Bearer ",
     *    					description="Token type"
     *    				),
     *    			),
     *    		),
     *    	),
     *      @OA\Response(
     *         response=422,
     *         description="Validation"
     *      ),
     *      @OA\Response(
     *         response=400,
     *         description="The given data was invalid"
     *      ),
     * )
     *
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json($this->createAccessToken());
        }

        return response()->json(__('auth.failed'), 400);
    }

    /**
     *  @OA\Post(
     *     path="/v1/auth/logout",
     *     tags={"Auth"},
     *     summary="Auth logout",
     *     operationId="auth.logout",
     *     security={{"token":{}}},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *         )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *    		@OA\MediaType(
     *    			mediaType="application/json",
     *    			@OA\Schema(
     *    				 @OA\Property(
     *                      property="boolean",
     *    					type="boolean",
     *    					example="true",
     *    				),
     *    			),
     *    		),
     *    	),
     * )

     */
    public function logout(Request $request)
    {
        return response()->json($request->user()->token()->revoke());
    }

    /**
     * Create access token
     *
     * @return array
     */
    private function createAccessToken()
    {
        return [
            'token' => auth()->user()->createToken('Personal Access Token')->accessToken,
            'token_type' => 'Bearer',
            'expires_in' => Carbon::now()->addMinutes(59)
        ];
    }
}
