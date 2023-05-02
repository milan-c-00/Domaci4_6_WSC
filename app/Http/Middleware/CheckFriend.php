<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckFriend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->route('user')->id;
        $loggedInUserId = auth()->id();

        $friendship = DB::table('friends')
            ->where(function ($query) use ($userId, $loggedInUserId) {
                $query->where('user_id', $userId)
                    ->where('friend_id', $loggedInUserId);
            })->orWhere(function ($query) use ($userId, $loggedInUserId) {
                $query->where('user_id', $loggedInUserId)
                    ->where('friend_id', $userId);
            })->first();

        if (!$friendship) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
