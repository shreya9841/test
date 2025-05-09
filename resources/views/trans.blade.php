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
        <h1>Transaction form</h1>
        <div>
            <form action="/trans/store" method="POST" class="flex flex-col">
                @csrf
                <div class="relative inline-block text-left">
                    <button onclick="toggleDropdown()" type="button"
                        class="inline-flex justify-center w-64 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none">
                        Select User
                    </button>

                    <div id="dropdownMenu"
                        class="absolute  w-44 mt-2  bg-white border border-gray-200 rounded-md shadow-lg hidden">
                        @foreach ($users as $user)
                        <a href="#" onclick="selectUser('{{ $user->name }}')" 
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ $user->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <label for="">Username</label>
                <input id="username" type="text" name="name" class="border border-gray-900 w-64 ">
                <label for="">Details</label>
                <input type="text" name="details" class="border border-gray-900 w-64">

                <button type="submit" class="bg-black text-white text-sm px-3 py-1 rounded hover:bg-gray-800 w-max mt-5">
                    Submit
                </button>
            </form>
        </div>

        <div>
            <table class="border border-black  ">
                <tr>
                    <th class="border border-black px-4 py-2">ID</th>
                    <th class="border border-black px-4 py-2">Name</th>
                    <th class="border border-black px-4 py-2">Details</th>
                </tr>
                @foreach($users as $item)
                <tr class="border border-black px-4 py-2">
                    <td class="border border-black px-4 py-2">{{$item->id}}</td>
                    <td class="border border-black px-4 py-2">{{$item->name}}</td>
                    <td class="border border-black px-4 py-2"> {{$item->email}}</td>
                    <td class="border border-black px-4 py-2">
                        <a href="{{ url('/users/' . $item->id . '/edit') }}"
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

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.classList.toggle('hidden');
        }

        function selectUser(username) {
            document.getElementById('username').value = username;
            toggleDropdown(); // Close the dropdown
        }
    </script>
</body>

</html>