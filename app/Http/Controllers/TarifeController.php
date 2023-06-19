<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Tarife;
use App\Services\TarifeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreTarifeRequest;
use App\Http\Requests\UpdateTarifeRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class TarifeControllerController
 * @package  App\Http\Controllers
 */
class TarifeController extends Controller
{
    private TarifeService $service;

    public function __construct(TarifeService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/tarife",
     *  operationId="indexTarife",
     *  tags={"Tarifes"},
     *  summary="Get list of Tarife",
     *  description="Returns list of Tarife",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Tarife"),
     *  ),
     * )
     *
     * Display a listing of Tarife.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(StoreTarifeRequest $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeTarife",
     *  summary="Insert a new Tarife",
     *  description="Insert a new Tarife",
     *  tags={"Tarifes"},
     *  path="/api/tarife",
     *  @OA\RequestBody(
     *    description="Tarife to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Tarife")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Tarife created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Tarife"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreTarifeRequest $request
     * @return array|Builder|Collection|Tarife|Builder[]|Tarife[]
     * @throws Throwable
     */
    public function store(StoreTarifeRequest $request): array |Builder|Collection|Tarife
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/tarife/{tarife_id}",
     *   summary="Show a Tarife from his Id",
     *   description="Show a Tarife from his Id",
     *   operationId="showTarife",
     *   tags={"Tarifes"},
     *   @OA\Parameter(ref="#/components/parameters/Tarife--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Tarife"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Tarife not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Tarife
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Tarife
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateTarife",
     *   summary="Update an existing Tarife",
     *   description="Update an existing Tarife",
     *   tags={"Tarifes"},
     *   path="/api/tarife/{tarife_id}",
     *   @OA\Parameter(ref="#/components/parameters/Tarife--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Tarife"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Tarife not found"),
     *   @OA\RequestBody(
     *     description="Tarife to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Tarife")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateTarifeRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Tarife|Tarife[]
     * @throws Throwable
     */
    public function update(UpdateTarifeRequest $request, int $crudgeneratorId): array |Tarife|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/tarife/{tarife_id}",
     *  summary="Delete a Tarife",
     *  description="Delete a Tarife",
     *  operationId="destroyTarife",
     *  tags={"Tarifes"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Tarife"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Tarife--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Tarife not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Tarife|Tarife[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Tarife
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}