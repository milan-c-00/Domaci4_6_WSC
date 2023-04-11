<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
     * Get all users except admin
     */
    public function index(){
        $users = User::query()->whereNot('role', 'admin')->paginate(8);
        return view('users.index', ['users' => $users]);
    }

    public function show(User $user){
        return view('users.show', ['user' => $user]);
    }

    public function create(){
        return view('users.create');
    }

    public function store(StoreUserRequest $request){
        $validated = $request->validated();
        $validated['password'] = bcrypt($request->password);    // Hashing password if it is validated
        User::query()->create($validated);
        return redirect()->route('users.index');
    }

    public function destroy(User $user, Request $request){
        $redirect_page = $this->calcRedirect($request->perPage, $request->total, $request->currentPage);
        $user->delete();
        return redirect()->route('users.index', ['page' => $redirect_page]);
    }

    public function edit(User $user){
        return view('users.edit', ['user' => $user]);
    }

    public function update(User $user, UpdateUserRequest $request){
        $validated = $request->validated();
        $validated['password'] = bcrypt($request->password);    // Hashing password if it is validated
        User::query()->where('id', $user->id)->update($validated);
        return redirect()->route('users.index');
    }

    private function calcRedirect($perPage, $total, $currentPage)
    {
        if ($total < $perPage)
            return 1;

        $numberOfElementsCurrentPage = $total - ($currentPage - 1) * $perPage;
        if ($numberOfElementsCurrentPage == 1)
            return $currentPage - 1;

        return $currentPage;
    }

}
