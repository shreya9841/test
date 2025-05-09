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
        <h1>Details Form</h1>
        <form action="{{ route('details.store') }}" method="POST" class="flex flex-col">
            @csrf

            <div class="relative inline-block text-left mb-4">
                <select name="user_id" class="border border-gray-300 p-2 rounded">
                    <option value="">Select User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div id="itemsContainer">
                <div class="flex gap-4 mb-2">
                    <input type="text" name="item[]" placeholder="Item" class="border border-gray-900 w-64">
                    <input type="text" name="amount[]" placeholder="Amount" class="border border-gray-900 w-64">
                </div>
            </div>

            <button type="button" onclick="addMoreItems()" class="bg-gray-600 text-white text-sm px-3 py-1 rounded hover:bg-gray-800 w-max mb-4">
                Add More Items
            </button>

            <button type="submit" class="bg-black text-white text-sm px-3 py-1 rounded hover:bg-gray-800 w-max">
                Submit
            </button>
        </form>
    </div>

    <script>
        function addMoreItems() {
            // Get the container where the items are displayed
            const container = document.getElementById('itemsContainer');
            
            // Create a new div for the item and price input
            const newItem = document.createElement('div');
            newItem.classList.add('flex', 'gap-4', 'mb-2');
            
            // Create the new input fields
            newItem.innerHTML = `
                <input type="text" name="item[]" placeholder="Item" class="border border-gray-900 w-64">
                <input type="text" name="amount[]" placeholder="Amount" class="border border-gray-900 w-64">
            `;
            
            // Append to the container
            container.appendChild(newItem);
        }
    </script>
</body>

</html>
