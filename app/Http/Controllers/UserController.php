<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Services\UserService;
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
class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
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
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
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
     * @param StoreUserRequest $request
     * @return array|Builder|Collection|User|Builder[]|User[]
     * @throws Throwable
     */
    public function store(StoreUserRequest $request): array |Builder|Collection|User
    {
        return $this->service->createModel($request->validated('data'));

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
     * @param $crudgeneratorId
     * @return array|Builder|Collection|User
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|User
    {
        return $this->service->getModelById($crudgeneratorId);
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
     * @return array|Builder|Builder[]|Collection|User|User[]
     * @throws Throwable
     */
    public function update(UpdateUserRequest $request, int $crudgeneratorId): array |User|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

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
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|User|User[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|User
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}