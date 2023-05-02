<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckFriendRequest
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

        $friendReq = DB::table('friend_requests')
            ->where(function ($query) use ($userId, $loggedInUserId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $loggedInUserId);
            })->orWhere(function ($query) use ($userId, $loggedInUserId) {
                $query->where('sender_id', $loggedInUserId)
                    ->where('receiver_id', $userId);
            })->first();

        if (!$friendReq) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
