<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Bouncer;

use App\User;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;

class UserController extends Controller {

    public function index() {
        return view('admin.users.index');
    }

    public function create() {
        $user = new User;
        $roles = Bouncer::role()->all();

        return view('admin.users.create', ['user' => $user, 'roles' => $roles]);
    }

    public function store(StoreUser $request) {
        $user = new User;

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->assign($request->role);

        return response()->json(['user' => $user, 'roles' => $request->role]);
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return view('admin.users.show', ['user' => $user]);
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        $roles = Bouncer::role()->all();
        $currentRole = $user->roles;

        return view('admin.users.edit', ['user' => $user, 'roles' => $roles, 'currentRole' => $currentRole]);
    }

    public function update(UpdateUser $request, $id) {
        $user = User::findOrFail($id);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['user' => $user]);
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['user' => $user]);
    }
}
