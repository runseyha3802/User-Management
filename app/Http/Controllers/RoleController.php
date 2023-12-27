<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request): Response
    {

        $roles = Role::where('name','<>','admin');
        if ($request->get('query'))
            $roles->where('name', 'LIKE', '%' . $request->get('query') . '%');

        $roles->orderBy('id', 'desc');

        return Inertia::render('Role/Index', [
            'users' => fn () => $roles->paginate($request->get('size', 10)),
        ]);
    }
    public function create(Request $request): Response
    {
        return Inertia::render('Role/CreateRole', [
//            'roles' => Role::whereNotIn('name', ['Admin'])->pluck('name')
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = new Role();
        $role->fill($request->all())->save();

        return to_route('Role.CreateRole');
    }

    public function destroy($id): RedirectResponse
    {
        Role::destroy($id);
        return to_route('role.index');
    }

    public function edit($id): Response
    {
        return Inertia::render('Role/EditRole', [
            'role' => Role::findById($id)
        ]);
    }
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
             ]);

        $role = Role::findOrFail($request->id);
        $role->fill($request->all())->save();

        return to_route('role.index');
    }
}
