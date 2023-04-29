<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function others(){

        $user = auth()->user();

        $others = User::query()
            ->where('id', '!=', auth()->user()->id)
            ->whereNot('role', 'admin')
            ->whereDoesntHave('friendsTo', function ($query) {
                $query->where('friend_id', auth()->user()->id);
            })
            ->whereDoesntHave('friendsFrom', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->whereDoesntHave('friendRequestsTo', function ($query) {
                $query->where('receiver_id', auth()->user()->id);
            })
            ->whereDoesntHave('friendRequestsFrom', function ($query) {
                $query->where('sender_id', auth()->user()->id);
            })
            ->get();

        return view('people.others', ['others' => $others]);
    }

    public function addFriend(User $user){

        DB::table('friend_requests')->insert([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $user->id
        ]);

        return $this->others();
    }

    public function friendRequests(){

        $requestsTo = auth()->user()->friendRequestsTo;
        $requestsFrom = auth()->user()->friendRequestsFrom;

        return view('people.requests', ['requests_to' => $requestsTo, 'requests_from' => $requestsFrom]);
    }

    public function removeRequest(User $user){

        DB::table('friend_requests')
            ->where('sender_id', auth()->user()->id)
            ->where('receiver_id', $user->id)
            ->delete();

        $requestsTo = auth()->user()->friendRequestsTo;
        $requestsFrom = auth()->user()->friendRequestsFrom;

        return redirect()->route('people.friendRequests', ['requests_to' => $requestsTo, 'requests_from' => $requestsFrom]);
    }

    public function acceptRequest(User $user){

        DB::table('friends')
            ->insert([
                'user_id' => auth()->user()->id,
                'friend_id' => $user->id
            ]);

        return $this->declineRequest($user);    // using decline function to delete request after accepting
    }

    public function declineRequest(User $user){
        DB::table('friend_requests')
            ->where('sender_id', $user->id)
            ->where('receiver_id', auth()->user()->id)
            ->delete();

        $requestsTo = auth()->user()->friendRequestsTo;
        $requestsFrom = auth()->user()->friendRequestsFrom;

        return redirect()->route('people.friendRequests', ['requests_to' => $requestsTo, 'requests_from' => $requestsFrom]);

    }

    public function friends(){

        $friendsTo = auth()->user()->friendsTo;
        $friendsFrom = auth()->user()->friendsFrom;

        $friends = $friendsTo->merge($friendsFrom);

        return view('people.friends', ['friends' => $friends]);

    }

    public function removeFriend(User $user){

        DB::table('friends')
            ->where('user_id', auth()->user()->id)
            ->where('friend_id', $user->id)
            ->orWhere('user_id', $user->id)
            ->where('friend_id', auth()->user()->id)
            ->delete();

        return $this->friends();

    }


}
