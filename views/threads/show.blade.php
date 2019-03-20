@extends('grid.two-column')

@section('content')
    <div class="thread-item px-6 py-8 hover:bg-grey-lightest rounded flex">
        <div class="">
            <div class="rounded-full h-16 w-16 flex avatar-circle items-center justify-center mr-6 bg-grey">
                <img class="rounded-full avatar-circle" src="{{ $thread['avatar_url'] }}" alt="">
            </div>
        </div>
        <div class="flex-1">
            <div class="flex justify-between">
                <div class="flex-1">
                    <p class="text-base truncate text-grey-darkest"><span class="text-blue"><a title="View all threads created by {{ $thread['username'] }}" href="/threads/user?username={{ $thread['username'] }}">{{ ucfirst($thread['username']) }}</a></span> ∙ {{ $thread['created_at'] }}</p>
                </div>
                <div class="flex flex-row justify-around items-center">
                    <div class="mr-4">
                        <i class="fas fa-eye text-grey"></i> {{ $thread['count.views'] }}
                    </div>
                    <div class="mr-4">
                        <i class="fas fa-comment text-grey"></i> {{ $thread['count.comments'] }}
                    </div>
                    <div class="thread-{{strtolower($thread['topic.title'])}} w-28 text-center px-4 py-1 text-blue border border-blue rounded-full text-xs">
                        {{ strtoupper($thread['topic.title']) }}
                    </div>
                </div>
            </div>

            <div class="thread-title bg-blue-lightest p-4 rounded mt-3 mb-2 md:mb-6">
                <h4>{{ $thread['title'] }}</h4>
            </div>

            <div class="mt-3">
                <p>{{ $thread['content'] }}</p>
            </div>
        </div>
    </div>


    @foreach ($comments as $comment)
        <div class="thread-item px-6 py-8 hover:bg-grey-lightest rounded cursor-pointer flex">
            <div class="">
                <div class="rounded-full h-16 w-16 flex avatar-circle items-center justify-center mr-6 bg-grey"><img class="rounded-full avatar-circle" src="{{ $comment['user.avatar'] }}" alt=""></div>
            </div>
            <div class="flex-1">
                <div class="flex justify-between">
                    <div class="flex-1">
                        <p class="text-base truncate text-grey-darkest"><span class="text-blue"><a title="View all threads created by {{ $comment['user.username'] }}" href="/threads/user?username={{ $comment['user.username'] }}">{{ ucfirst($comment['user.username']) }}</a></span> ∙ {{ $comment['created_at'] }}</p>
                    </div>
                </div>

                <div class="mt-3">
                    <p>{{ nl2br($comment['content']) }}</p>
                </div>

                <div class="flex mt-5 text-grey-dark">
                    <div class="flex-1 text-left">
                        <i class="fas fa-heart mr-1"></i> {{ $comment['karma_score'] }}
                    </div>
                    <div class="flex-1 text-right text-xs hover:text-grey-darkest">
                        Remove Comment
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection