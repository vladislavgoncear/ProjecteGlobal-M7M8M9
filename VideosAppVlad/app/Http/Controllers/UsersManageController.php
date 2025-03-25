<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class UsersManageController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $users = User::all();
        return view( 'users.manage.index', compact('users') );
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $team = Team::create([
            'name' => $request->name,
            'user_id' => $user->id,
            'personal_team' => true,
        ]);

        $user->current_team_id = $team->id;
        $user->save();

        return redirect()->route('users.manage.index')->with('success', 'User created successfully.');
    }

    // Show the form for editing the specified user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view( 'users.manage.edit', compact('user') );
    }

    // Update the specified user in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email', 'password'));

        return redirect()->route('users.manage.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    // Custom function to test by
    public function testedBy($id)
    {
        $user = User::findOrFail($id);
        // Implement your custom logic here
        return response()->json(['message' => 'Tested by function executed', 'user' => $user]);
    }

    public function create()
    {
        return view('users.manage.create');
    }


}
