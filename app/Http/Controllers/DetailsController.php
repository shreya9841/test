<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Total;
use App\Models\Detail;
use App\Models\User;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    // Show dropdown
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

        $totalamount = 0;


        foreach ($items as $index => $item) {

            $amounts = $amount[$index];


            Detail::create([
                'user_id' => $userId,
                'item' => $item,
                'amount' => $amounts,
                //'total_amount' => $totalamount,
            ]);
            $totalamount = $totalamount + $amounts;
        }
        $userTotal = Total::firstOrNew(['user_id' => $userId]);
        $userTotal->total_amount += $totalamount;
        $userTotal->save();


        return redirect()->route('details.index')->with('success', 'Details stored successfully!');
    }

    public function index()
    {
        $users = Detail::all();
        return view('details.index', compact('users'));
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $details = Detail::where('user_id', $id)->get();
        return view('details.edit', compact('user', 'details'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'item' => 'required|array',
            'amount' => 'required|array',
            'detail_id' => 'required|array',
            'item.*' => 'required|string',
            'amount.*' => 'required|integer',
        ]);

        $items = $request->input('item');
        $amounts = $request->input('amount');
        $detailIds = $request->input('detail_id');

        foreach ($items as $index => $item) {
            if (!empty($detailIds[$index])) {
                // If the ID exists, update the record
                $detail = Detail::findOrFail($detailIds[$index]);
                $detail->update([
                    'item' => $item,
                    'amount' => $amounts[$index],
                ]);
            } else {
                // If there is no ID, create a new record
                Detail::create([
                    'user_id' => $id,
                    'item' => $item,
                    'amount' => $amounts[$index],
                ]);
            }
        }

        $totalAmount = Detail::where('user_id', $id)->sum('amount');
        $userTotal = Total::firstOrNew(['user_id' => $id]);
        $userTotal->total_amount = $totalAmount;
        $userTotal->save();

        return redirect()->to('/items')->with('success', 'User updated successfully!');
    }


    public function show($userId)
    {
        $user = User::with(['details', 'total'])->findOrFail($userId);
        return view('details.user', compact('user'));
    }

    public function destroy($id)
    {
        $detail = Detail::findOrFail($id);
        $detail->delete();

        // After deleting, update the total amount in the totals table
        $userId = $detail->user_id;
        $totalAmount = Detail::where('user_id', $userId)->sum('amount');

        // Update the totals table
        $userTotal = Total::firstOrNew(['user_id' => $userId]);
        $userTotal->total_amount = $totalAmount;
        $userTotal->save();

        return redirect()->back()->with('success', 'Item deleted successfully!');
    }

    public function pay(Request $request, $id)
    {
        $paymentMethod = $request->query('payment_method');

        if (!$paymentMethod) {
            return redirect()->back()->with('error', 'Payment method is required.');
        }

        Payment::create([
            'user_id' => $id,
            'payment_method' => $request->payment_method,
        ]);

        // return redirect()->to('details/pay')->with('success', 'Payment method saved successfully!');
        return view('details.pay');
    }


    // public function pay($id)
    // {
    //     return view('details.pay', compact('id'));

    // }

    // public function reduce(Request $request, $id)
    // {
    //     $reduceAmount = $request->input('pay');
    //     $userTotal = Total::where('user_id', $id)->first();

    //     if ($userTotal) {

    //         if (is_null($userTotal->remaining) || $userTotal->remaining == 0.00) {
    //             $userTotal->remaining = $userTotal->total_amount;
    //         }


    //         if ($reduceAmount <= $userTotal->remaining) {
    //             $userTotal->remaining -= $reduceAmount;
    //             $userTotal->save();
    //         } else {
    //             return redirect()->back()->with('error', 'Reduction amount exceeds remaining balance!');
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'User not found!');
    //     }

    //     return redirect()->to('/items')->with('success', 'Remaining balance updated successfully!');
    // }
    public function reduce(Request $request, $id)
    {
        $reduceAmount = $request->input('pay');
        $paymentMethod = $request->input('payment_method');

        $userTotal = Total::where('user_id', $id)->first();

        if ($userTotal) {

            if (is_null($userTotal->remaining) || $userTotal->remaining == 0.00) {
                $userTotal->remaining = $userTotal->total_amount;
            }

            if ($reduceAmount <= $userTotal->remaining) {
                $userTotal->remaining -= $reduceAmount;
                $userTotal->save();

                // Save the payment method only after form submission
                Payment::create([
                    'user_id' => $id,
                    'payment_method' => $paymentMethod,
                ]);
            } else {
                return redirect()->back()->with('error', 'Reduction amount exceeds remaining balance!');
            }
        } else {
            return redirect()->back()->with('error', 'User not found!');
        }

        return redirect()->to('/items')->with('success', 'Remaining balance and payment method updated successfully!');
    }
}
