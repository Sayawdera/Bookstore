<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Founder;
use App\Services\FounderService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreFounderRequest;
use App\Http\Requests\UpdateFounderRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class FounderControllerController
 * @package  App\Http\Controllers
 */
class FounderController extends Controller
{
    private FounderService $service;

    public function __construct(FounderService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/founder",
     *  operationId="indexFounder",
     *  tags={"Founders"},
     *  summary="Get list of Founder",
     *  description="Returns list of Founder",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Founder"),
     *  ),
     * )
     *
     * Display a listing of Founder.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeFounder",
     *  summary="Insert a new Founder",
     *  description="Insert a new Founder",
     *  tags={"Founders"},
     *  path="/api/founder",
     *  @OA\RequestBody(
     *    description="Founder to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Founder")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Founder created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Founder"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreFounderRequest $request
     * @return array|Builder|Collection|Founder|Builder[]|Founder[]
     * @throws Throwable
     */
    public function store(StoreFounderRequest $request): array |Builder|Collection|Founder
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/founder/{founder_id}",
     *   summary="Show a Founder from his Id",
     *   description="Show a Founder from his Id",
     *   operationId="showFounder",
     *   tags={"Founders"},
     *   @OA\Parameter(ref="#/components/parameters/Founder--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Founder"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Founder not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Founder
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Founder
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateFounder",
     *   summary="Update an existing Founder",
     *   description="Update an existing Founder",
     *   tags={"Founders"},
     *   path="/api/founder/{founder_id}",
     *   @OA\Parameter(ref="#/components/parameters/Founder--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Founder"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Founder not found"),
     *   @OA\RequestBody(
     *     description="Founder to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Founder")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateFounderRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Founder|Founder[]
     * @throws Throwable
     */
    public function update(UpdateFounderRequest $request, int $crudgeneratorId): array |Founder|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/founder/{founder_id}",
     *  summary="Delete a Founder",
     *  description="Delete a Founder",
     *  operationId="destroyFounder",
     *  tags={"Founders"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Founder"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Founder--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Founder not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Founder|Founder[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Founder
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}