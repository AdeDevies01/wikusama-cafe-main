<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'title' => 'Pengguna',
            'users' => User::where('id', '!=', auth()->id())->options(request(['q', 'role', 'sortby', 'order']))->paginate(is_numeric(request('limit', 8)) ? request('limit', 8) : 8),
            'roles' => User::$roles,
            'sortables' => User::$sortables
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $validated_data = $request->validated();
        if ($request->hasFile('photo')) {
            $validated_data['photo'] = $this->uploadFile($request->file('photo'), public_path('img/users'));
        }

        $validated_data['password'] = bcrypt($validated_data['password']);

        $user = User::create($validated_data);

        $this->storeActivityLog('create', 'Membuat pengguna ' . $user->name);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'title' => 'Ubah Pengguna',
            'user' => $user
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated_data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                $this->deleteFile(public_path('img/users/' . $user->photo));
            }
            $validated_data['photo'] = $this->uploadFile($request->file('photo'), public_path('img/users'));
        } else if ($validated_data['delete_photo']) {
            if ($user->photo) {
                $this->deleteFile(public_path('img/users/' . $user->photo));
            }
            $validated_data['photo'] = null;
        }

        unset($validated_data['delete_photo']);

        if (!$validated_data['password']) {
            unset($validated_data['password']);
        } else {
            $validated_data['password'] = bcrypt($validated_data['password']);
        }

        $user->update($validated_data);

        $this->storeActivityLog('update', 'Mengubah pengguna ' . $user->name);

        return redirect($request->previous_url ?? route('users.index'))->with('success', 'Pengguna berhasil diubah!');
    }

    public function destroy(User $user)
    {
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan!');
        }
        if ($user->id == auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun anda sendiri!');
        }

        if ($user->photo) {
            $this->deleteFile(public_path('img/users/' . $user->photo));
        }

        $user->delete();

        $this->storeActivityLog('delete', 'Menghapus pengguna ' . $user->name);

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
    }
}
