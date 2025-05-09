<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\User;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    // Show the transaction form with dropdown
    public function create()
    {
        $users = User::all();
        return view('details.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'item' => 'required|array',
            'amount' => 'required|array',
            'item.*' => 'required|string',
            'amount.*' => 'required|integer',
        ]);

        $userId = $request->input('user_id');
        $items = $request->input('item');
        $amount = $request->input('amount');

        // Loop through items and prices to save each
        foreach ($items as $index => $item) {
            Detail::create([
                'user_id' => $userId,
                'item' => $item,
                'amount' => $amount[$index],
            ]);
        }

        return redirect('details/create')->with('success', 'Details stored successfully!');
    }

    public function index(){
        $users=Detail::all();
        return view('details/index',compact('users'));

    }

    public function edit($id){
        $user =Detail::findOrFail($id);
        return view('details/edit', compact('user'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'item' => 'required|array',
            'amount' => 'required|array',
            'item.*' => 'required|string',
            'amount.*' => 'required|integer',
        ]);

        $user=Detail::findOrFail($id);
        $user->update([
            'item' => $request->input('item'),
            'amount' =>$request->input('amount'),
            

        ]);
        return redirect('details/index')->with('success', 'User updated successfully!');

    }

    public function show($userId)
{
    $user = User::with('details')->findOrFail($userId);
    return view('details.user', compact('user'));
}

}
