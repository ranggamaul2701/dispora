<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $users = User::query()
            ->when($q !== '', fn ($w) => $w->where(fn ($x) => $x->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")))
            ->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users', 'q'));
    }

    public function create()
    {
        return view('admin.users.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $v = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:users,email',
            'password' => 'required|min:6',
            'role'     => ['required', Rule::in(['admin', 'tamu'])],
        ]);
        $user = User::create($v);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna "' . $user->name . '" berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', ['item' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $v = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|min:6',
            'role'     => ['required', Rule::in(['admin', 'tamu'])],
        ]);

        if ($user->isAdmin() && $v['role'] !== 'admin' && User::where('role', 'admin')->count() <= 1) {
            return back()->withInput()->with('error', 'Tidak bisa menurunkan satu-satunya admin.');
        }
        if (empty($v['password'])) {
            unset($v['password']);
        }
        $user->update($v);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna "' . $user->name . '" berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'Tidak bisa menghapus satu-satunya admin.');
        }
        $nama = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna "' . $nama . '" berhasil dihapus.');
    }
}
