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
        <form action="{{ url('/recycle/delete-all') }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete all soft-deleted users?')"
                class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 my-5 pl-5 ">
                Delete All
            </button>
        </form>

        <form action="{{ url('/recycle/delete-selected')  }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete the selected users?')" 
                class="bg-orange-500 text-white px-3 py-1 mt-3  rounded hover:bg-orange-600 ">
                Delete Selected
            </button>
        

        

        <table class="border border-black  ">
            <tr>
                <th class="border border-black px-4 py-2">Select</th>
                <th class="border border-black px-4 py-2">ID</th>
                <th class="border border-black px-4 py-2">Name</th>
                <th class="border border-black px-4 py-2">Email</th>
                <th class="border border-black px-4 py-2">Restore</th>
            </tr>
            @foreach($users as $item)
            <tr class="border border-black px-4 py-2">
                <td class="border border-black px-4 py-2">
                    <input type="checkbox" name="user_ids[]" value="{{ $item->id }}">
                </td>
                <td class="border border-black px-4 py-2">{{$item->id}}</td>
                <td class="border border-black px-4 py-2">{{$item->name}}</td>
                <td class="border border-black px-4 py-2"> {{$item->email}}</td>
                <td class="border border-black px-4 py-2">
                    <a href="{{ url('/restore/' . $item->id ) }}"
                        class="bg-green-700 text-white px-2 py-1 rounded hover:bg-green-600">
                        Restore
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
        </form>
    </div>
</body>

</html>