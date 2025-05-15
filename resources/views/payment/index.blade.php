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

    <table class="border border-black  ">
                <tr>
                    <th class="border border-black px-1 py-2">ID</th>
                    <th class="border border-black px-1 py-2">Name</th>
                    <th class="border border-black px-1 py-2">Payment Method</th>
                    <th class="border border-black px-1 py-2">Edit</th>

                </tr>
                @foreach($users as $item)
                <tr class="border border-black px-1 py-2">
                    <td class="border border-black px-1 py-2">{{$item->id}}</td>
                    <td class="border border-black px-1 py-2">{{ $item->user->name }}</td>
                    <td class="border border-black px-1 py-2">{{$item->payment_method}}</td>
                    <td class="border border-black px-4 py-2">
                        <a href="{{ url('/users/' . $item->id . '/payment/edit') }}"
                            class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">
                            Edit
                        </a>
                    </td>
                </tr>
                @endforeach
    </table>
    </div>
    
</body>
</html>