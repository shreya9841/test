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