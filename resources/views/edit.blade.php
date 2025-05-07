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
    <h1 class="pb-15">Edit Users</h1>
    <div class="h-15 w-15 ">
        
        <form action="{{ url('/users/' . $user->id) }}" method="POST" class="flex flex-col">
        @csrf
        @method('PUT')
            <label for="">Username</label>
            <input type="text" value="{{ $user->name }}" name="name" class="border border-gray-900 w-64 ">
            <label for="">Email</label>
            <input type="text" value="{{ $user->email }}" name="email" class="border border-gray-900 w-64">
            <label for="">Password</label>
            <input type="text" name="password" class="border border-gray-900 w-64">
            <button type="submit" class="bg-black text-white text-sm px-3 py-1 rounded hover:bg-gray-800 w-max mt-5">
                Update user
            </button>
            
        </form>
    </div>
</div>
</body>
</html>