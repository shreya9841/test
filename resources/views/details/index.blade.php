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
        <h1>View all details</h1>
        <div>
            <table class="border border-black  ">
                <tr>
                    <th class="border border-black px-4 py-2">ID</th>
                    <th class="border border-black px-4 py-2">Name</th>
                    <th class="border border-black px-4 py-2">Items</th>
                    <th class="border border-black px-4 py-2">Amount</th>
                </tr>
                @foreach($users as $item)
                <tr class="border border-black px-4 py-2">
                    <td class="border border-black px-4 py-2">{{$item->id}}</td>
                    <td class="border border-black px-4 py-2">{{$item->user_id}} </td>
                    <td class="border border-black px-4 py-2"> {{$item->item}}</td>
                    <td class="border border-black px-4 py-2"> {{$item->amount}}</td>
<!-- 
                    <td class="border border-black px-4 py-2">
                        <a href="{{ url('users/'.$item->id.'/details/user') }}" 
                        class="text-blue-500 hover:underline">View Details</a>
                    </td> -->

                    <td class="border border-black px-4 py-2">
                        <a href="{{ url('/users/' . $item->id . '/details/edit') }}"
                            class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">
                            Edit
                        </a>
                    </td>
                    <td>
                        <form action="{{ url('/users/' . $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')"
                                class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach


            </table>
        </div>
    </div>
</body>

</html>