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
        
        
        <form action="{{ route('details.reduce', $id)  }}" method="POST" class="flex flex-col gap-4 max-w-md p-5 mt-10 border
         border-gray-300 rounded-lg pt-15">
         @csrf
            <label for="pay" class="text-lg font-medium text-gray-700">Add Reducing Amount</label>

            <input type="number" name="pay" placeholder="Enter amount to reduce"
                class="border border-gray-400 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button type="submit"
                class="bg-gray-600 text-white font-medium px-4 py-2 rounded-md hover:bg-gray-700 transition duration-150">
                Submit
            </button>
        </form>

       
    </div>
</body>

</html>