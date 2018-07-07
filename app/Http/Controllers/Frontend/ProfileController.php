<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\User;
use App\Profile;

use App\Http\Requests\UpdateProfile;

class ProfileController extends Controller {
    
    public function show($slug) {
        $profile = Profile::findBySlugOrFail($slug);

        return view('frontend.profiles.show', ['profile' => $profile]);
    }

    public function edit($slug) {
        $profile = Profile::findBySlugOrFail($slug);

        return view('frontend.profiles.edit', ['profile' => $profile]);
    }

    public function update(UpdateProfile $request, $id) {
        $profile = Profile::findOrFail($id);

        // dd($request->date_of_birth);
        $profile->fill($request->except('date_of_birth'));
        $profile->date_of_birth = Carbon::parse($request->date_of_birth);

        if ($request->hasFile('picture')) {
            $profile->picture = 'user-' . $profile->user_id . '.jpg';
            $request->file('picture')->storeAs('public/profiles', $profile->picture);
        }

        $profile->save();

        return response()->json(['profile' => $profile]);
    }
}