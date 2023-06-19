<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class BrandControllerController
 * @package  App\Http\Controllers
 */
class BrandController extends Controller
{
    private BrandService $service;

    public function __construct(BrandService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/brand",
     *  operationId="indexBrand",
     *  tags={"Brands"},
     *  summary="Get list of Brand",
     *  description="Returns list of Brand",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Brand"),
     *  ),
     * )
     *
     * Display a listing of Brand.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(StoreBrandRequest $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeBrand",
     *  summary="Insert a new Brand",
     *  description="Insert a new Brand",
     *  tags={"Brands"},
     *  path="/api/brand",
     *  @OA\RequestBody(
     *    description="Brand to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Brand")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Brand created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Brand"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreBrandRequest $request
     * @return array|Builder|Collection|Brand|Builder[]|Brand[]
     * @throws Throwable
     */
    public function store(StoreBrandRequest $request): array |Builder|Collection|Brand
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/brand/{brand_id}",
     *   summary="Show a Brand from his Id",
     *   description="Show a Brand from his Id",
     *   operationId="showBrand",
     *   tags={"Brands"},
     *   @OA\Parameter(ref="#/components/parameters/Brand--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Brand"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Brand not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Brand
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Brand
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateBrand",
     *   summary="Update an existing Brand",
     *   description="Update an existing Brand",
     *   tags={"Brands"},
     *   path="/api/brand/{brand_id}",
     *   @OA\Parameter(ref="#/components/parameters/Brand--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Brand"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Brand not found"),
     *   @OA\RequestBody(
     *     description="Brand to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Brand")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateBrandRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Brand|Brand[]
     * @throws Throwable
     */
    public function update(UpdateBrandRequest $request, int $crudgeneratorId): array |Brand|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/brand/{brand_id}",
     *  summary="Delete a Brand",
     *  description="Delete a Brand",
     *  operationId="destroyBrand",
     *  tags={"Brands"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Brand"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Brand--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Brand not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Brand|Brand[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Brand
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}