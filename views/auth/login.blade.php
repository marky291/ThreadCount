@extends('grid.one-column')

@section('content')

    <h2 class="mb-6">Login to Account</h2>

    <div class="container mx-auto max-w-xl">
        <form action="/auth/login" method="POST">
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="shadow appearance-none {{ isset($errors['username']) ? 'border-red' : '' }} border rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" name="username" placeholder="Username">
                @if (isset($errors['username']))
                    <p class="text-red text-xs italic">{{ $errors['username'] }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none {{ isset($errors['password']) ? 'border-red' : '' }} border rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="******************">
                @if (isset($errors['password']))
                    <p class="text-red text-xs italic">{{ $errors['password'] }}</p>
                @endif
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Sign In
                </button>
            </div>
        </form>
    </div>
@endsection