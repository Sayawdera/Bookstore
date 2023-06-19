<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Faq;
use App\Services\FaqService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class FaqControllerController
 * @package  App\Http\Controllers
 */
class FaqController extends Controller
{
    private FaqService $service;

    public function __construct(FaqService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/faq",
     *  operationId="indexFaq",
     *  tags={"Faqs"},
     *  summary="Get list of Faq",
     *  description="Returns list of Faq",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Faq"),
     *  ),
     * )
     *
     * Display a listing of Faq.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(StoreFaqRequest $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeFaq",
     *  summary="Insert a new Faq",
     *  description="Insert a new Faq",
     *  tags={"Faqs"},
     *  path="/api/faq",
     *  @OA\RequestBody(
     *    description="Faq to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Faq")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Faq created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Faq"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreFaqRequest $request
     * @return array|Builder|Collection|Faq|Builder[]|Faq[]
     * @throws Throwable
     */
    public function store(StoreFaqRequest $request): array |Builder|Collection|Faq
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/faq/{faq_id}",
     *   summary="Show a Faq from his Id",
     *   description="Show a Faq from his Id",
     *   operationId="showFaq",
     *   tags={"Faqs"},
     *   @OA\Parameter(ref="#/components/parameters/Faq--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Faq"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Faq not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Faq
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Faq
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateFaq",
     *   summary="Update an existing Faq",
     *   description="Update an existing Faq",
     *   tags={"Faqs"},
     *   path="/api/faq/{faq_id}",
     *   @OA\Parameter(ref="#/components/parameters/Faq--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Faq"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Faq not found"),
     *   @OA\RequestBody(
     *     description="Faq to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Faq")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateFaqRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Faq|Faq[]
     * @throws Throwable
     */
    public function update(UpdateFaqRequest $request, int $crudgeneratorId): array |Faq|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/faq/{faq_id}",
     *  summary="Delete a Faq",
     *  description="Delete a Faq",
     *  operationId="destroyFaq",
     *  tags={"Faqs"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Faq"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Faq--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Faq not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Faq|Faq[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Faq
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}