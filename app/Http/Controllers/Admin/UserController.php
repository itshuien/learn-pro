<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Bouncer;

use App\User;
use App\Profile;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;

class UserController extends Controller {

    public function index() {
        $this->authorize('view', User::class);
        
        return view('admin.users.index');
    }

    public function apiIndex(Request $request) {
        $users = User::
            when($request->query('searchInput'), function($query) use ($request) {
                return $query->where('username', 'like', '%'.$request->query('searchInput').'%');
            })
            ->paginate(10);

        return new UserResourceCollection($users);
    }

    public function create() {
        $this->authorize('create', User::class);

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
        $user->profile()->save(new Profile);

        return response()->json(['user' => $user, 'roles' => $request->role]);
    }

    // public function show($id) {
    //     $user = User::findOrFail($id);
    //     return view('admin.users.show', ['user' => $user]);
    // }

    public function edit($id) {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);
        $roles = Bouncer::role()->all();

        return view('admin.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(UpdateUser $request, $id) {
        $user = User::findOrFail($id);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $profile = Profile::find($id);
        $profile->slug = null;
        $profile->save();

        return response()->json(['user' => $user]);
    }

    public function destroy($id) {
        $user = User::findOrFail($id);

        $this->authorize('delete', $user);
        $user->delete();

        return response()->json(['user' => $user]);
    }
}
