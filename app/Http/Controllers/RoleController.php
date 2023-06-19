<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class RoleControllerController
 * @package  App\Http\Controllers
 */
class RoleController extends Controller
{
    private RoleService $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/role",
     *  operationId="indexRole",
     *  tags={"Roles"},
     *  summary="Get list of Role",
     *  description="Returns list of Role",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Role"),
     *  ),
     * )
     *
     * Display a listing of Role.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(StoreRoleRequest $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeRole",
     *  summary="Insert a new Role",
     *  description="Insert a new Role",
     *  tags={"Roles"},
     *  path="/api/role",
     *  @OA\RequestBody(
     *    description="Role to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Role")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Role created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Role"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreRoleRequest $request
     * @return array|Builder|Collection|Role|Builder[]|Role[]
     * @throws Throwable
     */
    public function store(StoreRoleRequest $request): array |Builder|Collection|Role
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/role/{role_id}",
     *   summary="Show a Role from his Id",
     *   description="Show a Role from his Id",
     *   operationId="showRole",
     *   tags={"Roles"},
     *   @OA\Parameter(ref="#/components/parameters/Role--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Role"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Role not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Role
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Role
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateRole",
     *   summary="Update an existing Role",
     *   description="Update an existing Role",
     *   tags={"Roles"},
     *   path="/api/role/{role_id}",
     *   @OA\Parameter(ref="#/components/parameters/Role--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Role"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Role not found"),
     *   @OA\RequestBody(
     *     description="Role to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Role")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateRoleRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Role|Role[]
     * @throws Throwable
     */
    public function update(UpdateRoleRequest $request, int $crudgeneratorId): array |Role|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/role/{role_id}",
     *  summary="Delete a Role",
     *  description="Delete a Role",
     *  operationId="destroyRole",
     *  tags={"Roles"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Role"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Role--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Role not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Role|Role[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Role
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}