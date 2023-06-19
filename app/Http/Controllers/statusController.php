<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\status;
use App\Services\statusService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StorestatusRequest;
use App\Http\Requests\UpdatestatusRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class statusControllerController
 * @package  App\Http\Controllers
 */
class statusController extends Controller
{
    private statusService $service;

    public function __construct(statusService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/status",
     *  operationId="indexstatus",
     *  tags={"statuss"},
     *  summary="Get list of status",
     *  description="Returns list of status",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/status"),
     *  ),
     * )
     *
     * Display a listing of status.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(StorestatusRequest $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storestatus",
     *  summary="Insert a new status",
     *  description="Insert a new status",
     *  tags={"statuss"},
     *  path="/api/status",
     *  @OA\RequestBody(
     *    description="status to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/status")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="status created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/status"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StorestatusRequest $request
     * @return array|Builder|Collection|status|Builder[]|status[]
     * @throws Throwable
     */
    public function store(StorestatusRequest $request): array |Builder|Collection|status
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/status/{status_id}",
     *   summary="Show a status from his Id",
     *   description="Show a status from his Id",
     *   operationId="showstatus",
     *   tags={"statuss"},
     *   @OA\Parameter(ref="#/components/parameters/status--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/status"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="status not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|status
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|status
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updatestatus",
     *   summary="Update an existing status",
     *   description="Update an existing status",
     *   tags={"statuss"},
     *   path="/api/status/{status_id}",
     *   @OA\Parameter(ref="#/components/parameters/status--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/status"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="status not found"),
     *   @OA\RequestBody(
     *     description="status to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/status")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdatestatusRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|status|status[]
     * @throws Throwable
     */
    public function update(UpdatestatusRequest $request, int $crudgeneratorId): array |status|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/status/{status_id}",
     *  summary="Delete a status",
     *  description="Delete a status",
     *  operationId="destroystatus",
     *  tags={"statuss"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/status"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/status--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="status not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|status|status[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|status
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}