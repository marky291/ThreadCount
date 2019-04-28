@extends('grid.one-column')

@section('content')

    <h2 class="mb-6">Login to Account</h2>

    @if (isset($success))
        <div class="mb-6 bg-green-lightest border-l-4 border-green text-green-dark p-4" role="alert">
            <p class="font-bold">Success!.</p>
            <p>{{ $success['message']}}.</p>
        </div>
    @endif

    <div class="container mx-auto max-w-xl">
        <form action="/auth/login" method="POST">
            <div class="mb-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="username">
                    Username
                </label>
                <input class="{{ isset($errors['username']) ? 'border-red' : '' }} appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="username" type="text" name="username" placeholder="Username">
                @if (isset($errors['username']))
                    <p class="text-red text-xs italic">{{ $errors['username'] }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="password">
                    Password
                </label>
                <input class="{{ isset($errors['password']) ? 'border-red' : '' }} appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="password" type="password" name="password" placeholder="******************">
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