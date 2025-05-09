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
        <h1>Edit Details </h1>
        <form action="{{ url('/users/' . $user->id) }}" method="POST" class="flex flex-col">
            @csrf
            @method('PUT')
            <div id="itemsContainer">
                <div class="flex gap-4 mb-2">
                    <input type="text" value="{{ $user->item }}" name="item[]" placeholder="Item" class="border border-gray-900 w-64">
                    <input type="number" value="{{ $user->amount }}" name="amount[]" placeholder="Amount" class="border border-gray-900 w-64">
                </div>
            </div>

            <button type="button" onclick="addMoreItems()" class="bg-gray-600 text-white text-sm px-3 py-1 rounded hover:bg-gray-800 w-max mb-4">
                Add More Items
            </button>

            <button type="submit" class="bg-black text-white text-sm px-3 py-1 rounded hover:bg-gray-800 w-max">
                Update
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
