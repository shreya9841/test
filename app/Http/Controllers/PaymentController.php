<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $users = Payment::all();
        return view('payment.index', compact('users'));
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $user = User::findOrFail($payment->user_id);
        return view('payment.edit', compact('user', 'payment'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update([
            'payment_method' => $request->input('payment_method'),
        ]);

        return redirect()->route('payment.index')->with('success', 'Payment method updated successfully!');
    }
}
