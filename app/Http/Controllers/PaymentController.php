<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PaymentControllerController
 * @package  App\Http\Controllers
 */
class PaymentController extends Controller
{
    private PaymentService $service;

    public function __construct(PaymentService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/payment",
     *  operationId="indexPayment",
     *  tags={"Payments"},
     *  summary="Get list of Payment",
     *  description="Returns list of Payment",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Payment"),
     *  ),
     * )
     *
     * Display a listing of Payment.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storePayment",
     *  summary="Insert a new Payment",
     *  description="Insert a new Payment",
     *  tags={"Payments"},
     *  path="/api/payment",
     *  @OA\RequestBody(
     *    description="Payment to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Payment")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Payment created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Payment"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StorePaymentRequest $request
     * @return array|Builder|Collection|Payment|Builder[]|Payment[]
     * @throws Throwable
     */
    public function store(StorePaymentRequest $request): array |Builder|Collection|Payment
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/payment/{payment_id}",
     *   summary="Show a Payment from his Id",
     *   description="Show a Payment from his Id",
     *   operationId="showPayment",
     *   tags={"Payments"},
     *   @OA\Parameter(ref="#/components/parameters/Payment--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Payment"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Payment not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Payment
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Payment
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updatePayment",
     *   summary="Update an existing Payment",
     *   description="Update an existing Payment",
     *   tags={"Payments"},
     *   path="/api/payment/{payment_id}",
     *   @OA\Parameter(ref="#/components/parameters/Payment--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Payment"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Payment not found"),
     *   @OA\RequestBody(
     *     description="Payment to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Payment")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdatePaymentRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Payment|Payment[]
     * @throws Throwable
     */
    public function update(UpdatePaymentRequest $request, int $crudgeneratorId): array |Payment|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/payment/{payment_id}",
     *  summary="Delete a Payment",
     *  description="Delete a Payment",
     *  operationId="destroyPayment",
     *  tags={"Payments"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Payment"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Payment--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Payment not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Payment|Payment[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Payment
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}