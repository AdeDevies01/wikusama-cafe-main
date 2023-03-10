<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.index', ['title' => 'Profile']);
    }

    public function update(UpdateProfileRequest $request) {
        $validated_data = $request->validated();
        if ($request->hasFile('photo')) {
            $validated_data['photo'] = $this->uploadFile($request->file('photo'), public_path('img/users'));
        } else if ($validated_data['delete_photo']) {
            if (auth()->user()->photo) {
                $this->deleteFile(public_path('img/users/' . auth()->user()->photo));
            }
            $validated_data['photo'] = null;
        }

        unset($validated_data['delete_photo']);

        if ($validated_data['password']) {
            $validated_data['password'] = bcrypt($validated_data['password']);
        } else {
            unset($validated_data['password']);
        }

        $user = User::find(auth()->id());
        $user->update($validated_data);

        $this->storeActivityLog('update', 'Mengubah profile pribadi');

        return redirect()->route('profile.index')->with('success', 'Profile berhasil diperbarui!');
    }
}
