<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @include('navbar')
    <div class="ml-80">
        <h1>Edit Details</h1>
        <form action="" method="POST" class="flex flex-col">
            @csrf
            @method('PUT')

            <div id="itemsContainer">
                @foreach ($details as $detail)
                    <div class="flex gap-4 mb-2 items-center">
                        <input type="hidden" name="detail_id[]" value="{{ $detail->id }}">
                        <input type="text" value="{{ $detail->item }}" name="item[]" placeholder="Item"
                            class="border border-gray-900 w-64">
                        <input type="number" value="{{ $detail->amount }}" name="amount[]" placeholder="Amount"
                            class="border border-gray-900 w-64">

                        <!-- Separate form for Delete button -->
                        <button type="submit" onclick="return setUrl('delete', {{ $detail->id }})"
                            class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600">
                            Delete
                        </button>

                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addMoreItems()"
                class="bg-gray-600 text-white text-sm px-3 py-1 rounded hover:bg-gray-800 w-max mb-4">
                Add More Items
            </button>

            <button type="submit" onclick="return setUrl('update')"
                class="bg-black text-white text-sm px-3 py-1 rounded hover:bg-gray-800 w-max">
                
                Update
            </button>

        </form>

        <script>
            function addMoreItems() {
                const container = document.getElementById('itemsContainer');
                const newItem = document.createElement('div');
                newItem.classList.add('flex', 'gap-4', 'mb-2', 'items-center');
                newItem.innerHTML = `
                    <input type="hidden" name="detail_id[]" value="">
                    <input type="text" name="item[]" placeholder="Item" class="border border-gray-900 w-64">
                    <input type="number" name="amount[]" placeholder="Amount" class="border border-gray-900 w-64">
                    <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600">
                        Remove
                    </button>
                `;
                container.appendChild(newItem);
            }

            function setUrl(action, detailId = null) {
                const form = document.querySelector('form');
                const methodInput = form.querySelector('input[name="_method"]');
                if (action === 'delete' && detailId) {
                    if (confirm("Are you sure you want to delete this detail?")) {
                        form.action = `/details/${detailId}`;
                        if (methodInput) {
                            methodInput.value = 'DELETE';
                        } else {
                            const newMethodInput = document.createElement('input');
                            newMethodInput.type = 'hidden';
                            newMethodInput.name = '_method';
                            newMethodInput.value = 'DELETE';
                            form.appendChild(newMethodInput);
                        }
                        form.submit();
                    }
                } else {
                    form.action = `/users/{{ $user->id }}/details/update`;
                }
            }
        </script>

    </div>
</body>

</html>
