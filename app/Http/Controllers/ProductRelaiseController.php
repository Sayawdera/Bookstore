<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\ProductRelaise;
use App\Services\ProductRelaiseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreProductRelaiseRequest;
use App\Http\Requests\UpdateProductRelaiseRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ProductRelaiseControllerController
 * @package  App\Http\Controllers
 */
class ProductRelaiseController extends Controller
{
    private ProductRelaiseService $service;

    public function __construct(ProductRelaiseService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/productrelaise",
     *  operationId="indexProductRelaise",
     *  tags={"ProductRelaises"},
     *  summary="Get list of ProductRelaise",
     *  description="Returns list of ProductRelaise",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/ProductRelaise"),
     *  ),
     * )
     *
     * Display a listing of ProductRelaise.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeProductRelaise",
     *  summary="Insert a new ProductRelaise",
     *  description="Insert a new ProductRelaise",
     *  tags={"ProductRelaises"},
     *  path="/api/productrelaise",
     *  @OA\RequestBody(
     *    description="ProductRelaise to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/ProductRelaise")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="ProductRelaise created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/ProductRelaise"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreProductRelaiseRequest $request
     * @return array|Builder|Collection|ProductRelaise|Builder[]|ProductRelaise[]
     * @throws Throwable
     */
    public function store(StoreProductRelaiseRequest $request): array |Builder|Collection|ProductRelaise
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/productrelaise/{productrelaise_id}",
     *   summary="Show a ProductRelaise from his Id",
     *   description="Show a ProductRelaise from his Id",
     *   operationId="showProductRelaise",
     *   tags={"ProductRelaises"},
     *   @OA\Parameter(ref="#/components/parameters/ProductRelaise--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/ProductRelaise"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="ProductRelaise not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|ProductRelaise
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|ProductRelaise
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateProductRelaise",
     *   summary="Update an existing ProductRelaise",
     *   description="Update an existing ProductRelaise",
     *   tags={"ProductRelaises"},
     *   path="/api/productrelaise/{productrelaise_id}",
     *   @OA\Parameter(ref="#/components/parameters/ProductRelaise--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/ProductRelaise"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="ProductRelaise not found"),
     *   @OA\RequestBody(
     *     description="ProductRelaise to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/ProductRelaise")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateProductRelaiseRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|ProductRelaise|ProductRelaise[]
     * @throws Throwable
     */
    public function update(UpdateProductRelaiseRequest $request, int $crudgeneratorId): array |ProductRelaise|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/productrelaise/{productrelaise_id}",
     *  summary="Delete a ProductRelaise",
     *  description="Delete a ProductRelaise",
     *  operationId="destroyProductRelaise",
     *  tags={"ProductRelaises"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/ProductRelaise"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/ProductRelaise--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="ProductRelaise not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|ProductRelaise|ProductRelaise[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|ProductRelaise
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}