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
        <h1>Items Page</h1>
        <div>
            <table class="border border-black  ">
                <tr>
                    <th class="border border-black px-1 py-2">ID</th>
                    <th class="border border-black px-1 py-2">Name</th>
                    <th class="border border-black px-1 py-2">Email</th>
                    <th class="border border-black px-1 py-2">Total</th>
                    <th class="border border-black px-1 py-2">Remaining Amount</th>
                    <th class="border border-black px-1 py-2">View</th>
                    <th class="border border-black px-1 py-2">Edit</th>
                    <th class="border border-black px-1 py-2">Pay</th>

                </tr>
                @foreach($users as $item)
                <tr class="border border-black px-1 py-2">
                    <td class="border border-black px-1 py-2">{{$item->id}}</td>
                    <td class="border border-black px-1 py-2">{{$item->name}}</td>
                    <td class="border border-black px-1 py-2"> {{$item->email}}</td>
                    <td class="border border-black px-1 py-2">
                        {{ $item->total ? $item->total->total_amount : '0.00' }}
                    </td>
                    <td class="border border-black px-1 py-2">
                        {{ $item->total ? $item->total->remaining : '0.00' }}
                    </td>

                    <td class="border border-black px-1 py-2">
                        <a href="{{ url('users/'.$item->id.'/details/user') }}"
                            class="text-blue-500 hover:underline">View Details</a>
                    </td>

                    <td class="border border-black px-1 py-2">
                        <a href="{{ url('/users/' . $item->id . '/details/edit') }}"
                            class="bg-purple-500 text-white px-1 py-1 rounded hover:bg-purple-600">
                            Edit items and amount
                        </a>
                    </td>

                    <!-- <td class="border border-black px-1 py-2">
                        <select onchange="location = this.value" class="border border-gray-300 p-2 rounded">
                            <option value="">Payment method</option>
                            <option value="{{ url('/users/' . $item->id . '/details/pay') }}">Cash pay</option>
                            <option value="{{ url('/users/' . $item->id . '/details/pay') }}">Card pay</option>
                            <option value="{{ url('/users/' . $item->id . '/details/pay') }}">Phone pay</option>
                        </select>
                    </td> -->

                    <td class="border border-black px-1 py-2">
                        <select
                       
                            id="paymentMethod"
                            class="border border-gray-300 p-2 rounded"
                            onchange="if(this.value) { 
                            window.location.href = '{{ url('/users/' . $item->id . '/details/pay') }}?payment_method=' + this.value; }">
                            <option value=""> Payment Method</option>
                            <option value="Cash">Cash pay</option>
                            <option value="Card">Card pay</option>
                            <option value="Phone">Phone pay</option>
                        </select>
                    </td>



                </tr>
                @endforeach



            </table>
        </div>
    </div>
</body>

<script>
    function updateTrans($id) {

    }

</script>

</html>
