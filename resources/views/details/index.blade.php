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


                    
                        </form>

                    </td>
                </tr>
                @endforeach


            </table>
        </div>
    </div>
</body>

</html>