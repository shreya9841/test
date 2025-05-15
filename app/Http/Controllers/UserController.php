<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // Show the list of users
    public function index()
    {
        $users = User::all();
        return view('profile', compact('users'));
    }

    // Show the form to create a new user
    public function create()
    {
        return view('create');
    }

    // Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->input('user'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect('/profile')->with('success', 'User created successfully!');
    }

    // Show the form to edit a user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit', compact('user'));
    }

    // Update the user data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect('/profile')->with('success', 'User updated successfully!');
    }

    // Delete the user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/profile')->with('success', 'User deleted successfully!');
    }

    public function show()
    {
        // $users = User::all();
        // return view('items', compact('users'));
        $users = User::with('total')->get();
        return view('items', compact('users'));
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return redirect('/profile')->with('success', 'User deleted successfully!');
    }

    public function recycle()
    {
        $users = User::onlyTrashed()->get();
        return view('recycle', compact('users'));
    }

    // public function deleteall($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->forceDelete();
    //     return redirect('/profile')->with('success', 'User deleted successfully!');
    // }
    public function deleteall()
    {
        User::onlyTrashed()->forceDelete();
        return redirect('/recycle')->with('success', 'All soft-deleted users have been permanently deleted!');
    }
}
