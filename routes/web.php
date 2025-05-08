<?php

use App\Models\Transac;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('navbar',function(){
    return view('navbar');
    
});

Route::get('about',function(){
    return view('about');

});
Route::get('contact',function(){
    return view('contact');

});


//Store
Route::post('/users', function (Request $request) {
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

    return redirect('/')->with('success', 'User created successfully!');
});

//SHOW
Route::get('/profile', function () {
    $users = User::all();
    return view('profile', compact('users'));
});

// Show the Edit Form
Route::get('/users/{id}/edit', function ($id) {
    $user = User::findOrFail($id); // Fetch the user by ID
    return view('edit', compact('user')); // Pass user data to the view
});

// Update the User
Route::put('/users/{id}', function (Request $request, $id) {
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
});

//DELETE user
Route::delete('/users/{id}', function ($id) {
    $user = User::findOrFail($id);
    $user->delete();
    return redirect('/profile')->with('success', 'User deleted successfully!');
});



//show in dropdown
Route::get('/trans', function () {
    $users = User::all();
    return view('trans', compact('users'));
});

//show transaction
Route::get('/viewtrans', function () {
    $users = Transac::all();
    return view('viewtrans', compact('users'));
});


//Store transaction
Route::post('/trans/store', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'details'=>'required',
    ]);

    Transac::create([
        'name' => $request->input('name'),
        'details' => $request->input('details'),
        
    ]);

    return redirect('trans')->with('success', 'User created successfully!');
});

//edit transaction
Route::get('/users/{id}/edittrans', function ($id) {
    $user = Transac::findOrFail($id); // Fetch the user by ID
    return view('edittrans', compact('user')); // Pass user data to the view
});

// Update the transaction
Route::put('/users/{id}', function (Request $request, $id) {
    $request->validate([
        'name' => 'required|string|max:255',
        'details' => 'required' ,
    ]);

    $user = Transac::findOrFail($id);
    $user->update([
        'name' => $request->input('name'),
        'details' => $request->input('details'),
    ]);

    return redirect('/viewtrans')->with('success', 'U updated successfully!');
});

//delete transaction
Route::delete('/users/{id}', function ($id) {
    $user = Transac::findOrFail($id);
    $user->delete();
    return redirect('/viewtrans')->with('success', ' deleted successfully!');
});