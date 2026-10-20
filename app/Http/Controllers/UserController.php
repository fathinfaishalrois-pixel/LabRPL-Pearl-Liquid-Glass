<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }
    public function create() { return view('users.form', ['user' => new User()]); }
    public function store(Request $request)
    {
        $data = $this->validated($request);
        User::create($data);
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }
    public function show(User $user) { return view('users.show', compact('user')); }
    public function edit(User $user) { return view('users.form', compact('user')); }
    public function update(Request $request, User $user)
    {
        $data = $this->validated($request, $user);
        if (empty($data['password'])) unset($data['password']);
        $user->update($data);
        return redirect()->route('pengguna.index')->with('success', 'Data pengguna diperbarui.');
    }
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        if ($user->loans()->exists()) return back()->with('error', 'Pengguna memiliki riwayat peminjaman.');
        $user->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna dihapus.');
    }
    private function validated(Request $request, ?User $user = null): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user?->id)],
            'role' => ['required', Rule::in(['admin', 'siswa'])],
        ];
        $rules['password'] = $user
            ? ['nullable', 'string', 'min:8', 'confirmed']
            : ['required', 'string', 'min:8', 'confirmed'];
        return $request->validate($rules);
    }
}
