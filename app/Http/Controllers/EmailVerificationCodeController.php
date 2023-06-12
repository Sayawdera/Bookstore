<?php
namespace App\Http\Controllers;

use App\Http\Requests\CheckEmailVerificationCodeRequest;
use Illuminate\Http\JsonResponse;
use Throwable;
use App\Models\EmailVerificationCode;
use App\Services\EmailVerificationCodeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreEmailVerificationCodeRequest;
use App\Http\Requests\UpdateEmailVerificationCodeRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class EmailVerificationCodeControllerController
 * @package  App\Http\Controllers
 */
class EmailVerificationCodeController extends Controller
{
    private EmailVerificationCodeService $service;

    public function __construct(EmailVerificationCodeService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/emailverificationcode",
     *  operationId="indexEmailVerificationCode",
     *  tags={"EmailVerificationCodes"},
     *  summary="Get list of EmailVerificationCode",
     *  description="Returns list of EmailVerificationCode",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/EmailVerificationCode"),
     *  ),
     * )
     *
     * Display a listing of EmailVerificationCode.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function sendEmailVerification(StoreEmailVerificationCodeRequest $request): array|Builder|Collection|EmailVerificationCode
    {
        return $this->service->createModel($request->validated('data'));
    }

    /**
     * @OA\Post(
     *  operationId="storeEmailVerificationCode",
     *  summary="Insert a new EmailVerificationCode",
     *  description="Insert a new EmailVerificationCode",
     *  tags={"EmailVerificationCodes"},
     *  path="/api/emailverificationcode",
     *  @OA\RequestBody(
     *    description="EmailVerificationCode to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/EmailVerificationCode")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="EmailVerificationCode created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/EmailVerificationCode"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param CheckEmailVerificationCodeRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function checkEmailVerification(CheckEmailVerificationCodeRequest $request)
    {
        return $this->service->checkVerificationCode($request->validated('data'));

    }
}