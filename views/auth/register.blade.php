@extends('grid.one-column')

@section('content')

    <h2 class="mb-6">Register Account</h2>

    @if (isset($errors))
        <div class="mb-6 bg-red-lightest border-l-4 border-red text-red-dark p-4" role="alert">
            <p class="font-bold">Registration failed.</p>
            <p>{{ $errors['message'] }}.</p>
        </div>
    @endif

    <div class="container mx-auto max-w-xl">
        <form class="w-full" method="post" action="/auth/register" id="register-account-form">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="username">
                        Username
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="username" type="text" name="username" value="{{ $flash['username'] or '' }}">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="email" type="email" name="email" value="{{ $flash['email'] or '' }}">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="password" type="password" name="password" autocomplete="new-password">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="retypePassword">
                        Retype Password
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="retypePassword" type="password" name="retypePassword">
                </div>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Create my Account
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            $("#register-account-form").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 35,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 3,
                        maxlength: 45,
                    },
                    retypePassword: {
                        equalTo: "#password"
                    }
                }
            });
        </script>
    @endpush

@endsection