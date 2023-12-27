<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //

    public function index(Request $request): Response
    {

        $users = User::with('roles')->withoutRole('admin');
        if ($request->get('query'))
            $users->where('name', 'LIKE', '%' . $request->get('query') . '%');

        $users->orderBy('id', 'desc');

        return Inertia::render('User/Index', [
            'users' => fn () => $users->paginate($request->get('size', 10)),
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('User/Create', [
            'roles' => Role::whereNotIn('name', ['Admin'])->pluck('name')
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User();
        $user->fill($request->all())->save();
        $user->assignRole($request->role);

        return to_route('user.index');
    }

    public function edit($id): Response
    {
        return Inertia::render('User/Edit', [
            'user' => User::with('roles')->find($id),
            'roles' => Role::whereNotIn('name', ['Admin'])->pluck('name')
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($request->id)],
        ]);

        $user = User::findOrFail($request->id);
        $user->fill($request->all())->save();

        if (!$user->hasRole($request->role))
            $user->syncRoles($request->role);

        return to_route('user.index');
    }

    public function destroy($id): RedirectResponse
    {
        User::destroy($id);
        return to_route('user.index');
    }
}
