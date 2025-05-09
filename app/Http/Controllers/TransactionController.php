<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TransactionController extends Controller
{
    // Show the transaction form with dropdown
    public function create()
    {
        $users = User::all();
        return view('trans', compact('users'));
    }

    // Store the transaction
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'details' => 'required',
        ]);

        Transac::create([
            'user_id' => $request->input('user_id'),
            'details' => $request->input('details'),
        ]);

        return redirect('/trans')->with('success', 'Transaction created successfully!');
    }

    // Display all transactions
    public function index()
    {
        $users = Transac::all();
        return view('viewtrans', compact('users'));
    }

    // Show the form to edit a transaction
    public function edit($id)
    {
        $user = Transac::findOrFail($id);
        return view('edittrans', compact('user'));
    }

    // Update the transaction
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'required',
        ]);

        $user = Transac::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'details' => $request->input('details'),
        ]);

        return redirect('/viewtrans')->with('success', 'Transaction updated successfully!');
    }

    // Delete the transaction
    public function destroy($id)
    {
        $user = Transac::findOrFail($id);
        $user->delete();
        return redirect('/viewtrans')->with('success', 'Transaction deleted successfully!');
    }
}
