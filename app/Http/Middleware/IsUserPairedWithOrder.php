<?php

namespace App\Http\Middleware;

use App\Interfaces\OrderRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsUserPairedWithOrder
{
    function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
    )
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($this->orderRepository
            ->getOrderById($request->route('order'))
            ->users()->where('user_id', $user->id)
            ->exists()) return $next
        ($request);
        return response("User $user->name doesn't have access", Response::HTTP_FORBIDDEN);
    }
}
