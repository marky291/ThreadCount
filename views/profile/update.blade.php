@extends('grid.two-column')

@section('content')

    <div class="markdown mb-6 mx-auto border-l-4 border-blue pl-3">
        <h3 class="text-blue">Profile of {{ ucfirst($profile['username']) }}</h3>
        <div class="text-l text-grey-dark mb-4">
            Update existing credentials of the users profile.
        </div>
    </div>

    <form class="w-full" id="create-thread-form" method="post" action="/profile/update">

        <input type="hidden" id="profileID" name="profileID" value="{{ $profile['user_id'] }}">

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 mb-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-username">
                    Username
                </label>
                <input name="username" class="appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3 px-4 border border-grey-lighter leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-username" type="text" placeholder="{{ ucfirst($profile['username']) }}" value="{{ ucfirst($profile['username']) }}">
            </div>
            <div class="w-full px-3 mb-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-email">
                    Email
                </label>
                <input name="email" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-email" placeholder="{{ ucfirst($profile['email']) }}" value="{{ ucfirst($profile['email']) }}">
            </div>
            <div class="w-full px-3 mb-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-avatarUrl">
                    Avatar Url
                </label>
                <input name="avatarUrl" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-avatarUrl" placeholder="{{ ($profile['avatar_url']) }}" value="{{ ($profile['avatar_url']) }}">
            </div>
            @if(auth()->check() && auth()->user()->hasRole(['super', 'admin']))
            <div class="w-full px-3 mb-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
                    Role
                </label>
                <select name="roleID" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="" cols="30" rows="10" placeholder="Describe the new topic">
                    @foreach ($roles as $role)
                        <option value="{{ $role['role_id'] }}" {{ $profile['role_id'] == $role['role_id'] ? 'selected' : null }}>{{ ucfirst($role['name']) }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>
        <div class="flex items-center justify-between float-right">
            <button id="cancel-button" class="text-xs bg-white text-blue w-full hover:bg-blue-dark border-blue-light border hover:text-white font-bold py-2 px-4 rounded-l">
                Cancel
            </button>
            <button class="text-xs bg-blue-light w-full hover:bg-blue-dark text-white font-bold border border-blue-light py-2 px-4 rounded-r" type="submit">
                Save
            </button>
        </div>
    </form>

    @push('scripts')
        <script>
            $("#cancel-button").click(function(event) {
                event.preventDefault();
                window.location.replace("/"); // return to homepage;
            });

            $("#create-thread-form").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 5,
                        maxlength: 45,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    avatarUrl: {
                        required: true,
                        url: true
                    },
                    roleID: {
                        required: true
                    }
                }
            });
        </script>
    @endpush

@endsection