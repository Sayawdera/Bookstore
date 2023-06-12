<?php
namespace App\Http\Controllers\Auth;

use App\Dtos\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class UserControllerController
 * @package  App\Http\Controllers
 */
class AuthController extends Controller
{
    private AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/user",
     *  operationId="indexUser",
     *  tags={"Users"},
     *  summary="Get list of User",
     *  description="Returns list of User",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/User"),
     *  ),
     * )
     *
     * Display a listing of User.
     * @return JsonResponse
     * @throws Throwable
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->service->login($request->validated());
    }

    /**
     * @OA\Post(
     *  operationId="storeUser",
     *  summary="Insert a new User",
     *  description="Insert a new User",
     *  tags={"Users"},
     *  path="/api/user",
     *  @OA\RequestBody(
     *    description="User to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/User")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="User created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/User"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->service->register($request->validated());

    }

    /**
     * @OA\Get(
     *   path="/api/user/{user_id}",
     *   summary="Show a User from his Id",
     *   description="Show a User from his Id",
     *   operationId="showUser",
     *   tags={"Users"},
     *   @OA\Parameter(ref="#/components/parameters/User--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/User"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="User not found"),
     * )
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        return $this->service->resetPassword($request->validated());
    }

    /**
     * @OA\Patch(
     *   operationId="updateUser",
     *   summary="Update an existing User",
     *   description="Update an existing User",
     *   tags={"Users"},
     *   path="/api/user/{user_id}",
     *   @OA\Parameter(ref="#/components/parameters/User--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/User"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="User not found"),
     *   @OA\RequestBody(
     *     description="User to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/User")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateUserRequest $request
     * @param int $crudgeneratorId
     * @return JsonResponse
     * @throws Throwable
     */
    public function logout(): JsonResponse
    {
        return ApiResponse::success($this->service->logout());
    }

    /**
     * @OA\Delete(
     *  path="/api/user/{user_id}",
     *  summary="Delete a User",
     *  description="Delete a User",
     *  operationId="destroyUser",
     *  tags={"Users"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/User"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/User--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="User not found"),
     * )
     *
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function checkUserToken(): JsonResponse
    {
        $success = Auth()->user();

        if ($success)
        {
            return ApiResponse::success($success);
        }else{
            return ApiResponse::error("Error Email not found", Response::HTTP_UNAUTHORIZED);
        }
    }

    public function updateYourSelf(Request $request)
    {
        auth()->user()->update($request->all());

        return ApiResponse::success(auth()->user());
    }
}