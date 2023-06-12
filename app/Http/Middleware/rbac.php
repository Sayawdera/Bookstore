<?php

namespace App\Http\Middleware;

use App\Dtos\ApiResponse;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as ResponseAlias;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class rbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next): ResponseAlias|JsonResponse|RedirectResponse
    {

        $action = explode('.', $request->route()->getAction('as'));
        $user = auth()->user();

        if (empty($user))
        {
            $userActiveROle = 'guest';
        }else{
            $userActiveROle = !empty($user->getActiveRole()) ? $user->getActiveRole()->role_code : 'guest';
        }
        $rbac = config('rbac' . $userActiveROle);

        if (is_null($rbac) or !array_key_exists($action[0], $rbac) or !in_array($action[1], $rbac[$action[0]]))
        {
            return ApiResponse::error('NOT ALLOWED', Response::HTTP_METHOD_NOT_ALLOWED);
        }

        return $next($request);
    }
}
