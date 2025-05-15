<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @include('navbar')

    <div class="ml-80">
        <h1 class="pb-15">Edit Payment Method</h1>
        <div class="h-15 w-15 ">

            <form action="{{ route('payment.update', $payment->id) }}" method="POST" class="flex flex-col">
                @csrf
                @method('PUT')
                <label for="payment_method" class="block">Select Payment Method</label>
                <select name="payment_method" id="payment_method" class="border border-gray-900 w-64 mt-2">
                    <option value="Cash" {{ $payment->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                    <option value="Card" {{ $payment->payment_method == 'Card' ? 'selected' : '' }}>Card</option>
                    <option value="Phone" {{ $payment->payment_method == 'Phone' ? 'selected' : '' }}>Phone</option>
                </select>

                <button type="submit" class="bg-black text-white text-sm px-3 py-1 rounded hover:bg-gray-800 w-max mt-5">
                    Update Payment
                </button>

            </form>
        </div>
    </div>
</body>

</html>