<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @include('navbar')

    <div class="ml-80">
        <h1>User Details for {{ $user->name }}</h1>

        <h2 class="text-lg font-bold mb-4">Items Purchased</h2>
        @if($user->details->count() > 0)
            <table class="border border-black">
                <tr>
                    <th class="border border-black px-4 py-2">Item</th>
                    <th class="border border-black px-4 py-2">Amount</th>
                     <th class="border border-black px-4 py-2">Total amount</th>
                </tr>

                @foreach($user->details as $detail)
                <tr class="border border-black px-4 py-2">
                    <td class="border border-black px-4 py-2">{{ $detail->item }}</td>
                    <td class="border border-black px-4 py-2">{{ $detail->amount }}</td>
                    <td class="border border-black px-4 py-2">{{ $detail->total_amount }}</td>
                </tr>
                @endforeach
            </table>
        @else
            <p class="text-red-500">No items found for this user.</p>
        @endif
    </div>

</body>

</html>
