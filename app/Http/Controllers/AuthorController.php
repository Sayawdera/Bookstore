<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class AuthorControllerController
 * @package  App\Http\Controllers
 */
class AuthorController extends Controller
{
    private AuthorService $service;

    public function __construct(AuthorService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/author",
     *  operationId="indexAuthor",
     *  tags={"Authors"},
     *  summary="Get list of Author",
     *  description="Returns list of Author",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Author"),
     *  ),
     * )
     *
     * Display a listing of Author.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeAuthor",
     *  summary="Insert a new Author",
     *  description="Insert a new Author",
     *  tags={"Authors"},
     *  path="/api/author",
     *  @OA\RequestBody(
     *    description="Author to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Author")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Author created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Author"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreAuthorRequest $request
     * @return array|Builder|Collection|Author|Builder[]|Author[]
     * @throws Throwable
     */
    public function store(StoreAuthorRequest $request): array |Builder|Collection|Author
    {
        return $this->service->createModel($request->validated('data'));
    }

    /**
     * @OA\Get(
     *   path="/api/author/{author_id}",
     *   summary="Show a Author from his Id",
     *   description="Show a Author from his Id",
     *   operationId="showAuthor",
     *   tags={"Authors"},
     *   @OA\Parameter(ref="#/components/parameters/Author--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Author"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Author not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Author
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Author
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateAuthor",
     *   summary="Update an existing Author",
     *   description="Update an existing Author",
     *   tags={"Authors"},
     *   path="/api/author/{author_id}",
     *   @OA\Parameter(ref="#/components/parameters/Author--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Author"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Author not found"),
     *   @OA\RequestBody(
     *     description="Author to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Author")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateAuthorRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Author|Author[]
     * @throws Throwable
     */
    public function update(UpdateAuthorRequest $request, int $crudgeneratorId): array |Author|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/author/{author_id}",
     *  summary="Delete a Author",
     *  description="Delete a Author",
     *  operationId="destroyAuthor",
     *  tags={"Authors"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Author"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Author--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Author not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Author|Author[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Author
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}