<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('roles')->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'status'=>$user->status,
                    'created_at'=>$user->created_at,
                    'department'=>$user->department,
                    'level'=>$user->level,
                    'roles' => $user->getRoleNames(), // Spatie method to get role names
                ];
            });

            return response()->json($users);
        }
         return view('admin.user');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'employee_code' => 'required|string|max:50',
        'department' => 'required|string|max:100',
        'role' => 'required|string',
        'level' => 'required',
        'manager_id' => 'required',
        'status' => 'required|in:active,inactive',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->employee_code = $request->employee_code;
    $user->department = $request->department;
    $user->level = $request->level;
    $user->manager_id = $request->manager_id;
    $user->status = $request->status;
    $user->password = Hash::make('default123'); // Default password

    $user->save();

    // Assign role
    $user->assignRole($request->role);

    return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = $user->getRoleNames();
        return response()->json([
        'user' => $user,
        'roles' => $roles,
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'employee_code' => 'required|string|max:50',
            'department' => 'required|string|max:100',
            'role' => 'required|string',
            'level' => 'required|string|max:50',
            'manager_id' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->employee_code = $request->employee_code;
        $user->department = $request->department;
        $user->level = $request->level;
        $user->manager_id = $request->manager_id;
        $user->status = $request->status;

        $user->save();

        // Sync role
        $user->syncRoles([$request->role]);

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // soft delete
        return response()->json(['status' => 'success', 'message' => 'User deleted successfully']);
    }
}
