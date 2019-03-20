@extends('master')

@section('grid')
    <div class="w-full px-6 py-12 border-t">
        <div class="container py-4 mx-auto max-w-xl">
            <form action="/auth/validate" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-sm">
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
                    <a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker" href="#">
                        Forgot Password?
                    </a>
                </div>
            </form>
            <p class="text-center text-grey text-xs">
                ©2019 Acme Corp. All rights reserved.
            </p>
        </div>
    </div>
@endsection