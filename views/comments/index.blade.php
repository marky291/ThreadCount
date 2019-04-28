@extends('grid.two-column')

@section('content')
    @if (count($comments) < 1)
        <div class="flex flex-col items-center">
            <img src="https://ya-webdesign.com/images/vision-vector-colorful-2.png"
                 alt="A person searching" style="height:200px; width: 200px;">

            <h4 class="text-grey-darkest">Uh oh! There are no comments to be shown!</h4>
        </div>
    @else
        @foreach ($comments as $comment)
            <div class="thread-item px-6 py-8 hover:bg-grey-lightest rounded flex">
                <div class="">
                    <div class="rounded-full h-16 w-16 flex avatar-circle items-center justify-center mr-6 bg-grey">
                        <a href="/profile/update?username={{ $comment['user.username'] }}">
                            <img class="border hover:border-solid hover:border-grey hover:shadow rounded-full avatar-circle" src="//www.gravatar.com/avatar/c2d52abc9f91d455e15a48d59fecd746?s=100&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fdefault-square-avatar.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between">
                        <div class="flex-1">
                            <p class="text-base truncate text-grey-darkest">
                                <span class="text-blue">
                                    <a class="font-bold text-blue" title="View all threads created by {{ $comment['user.username'] }}" href="/threads/user?username={{ $comment['user.username'] }}">
                                        {{ ucfirst($comment['user.username']) }}
                                    </a>
                                </span>
                                ∙ {{ Carbon\Carbon::createFromTimestamp(strtotime($comment['created_at']))->diffForHumans() }}
                                on '<a class="text-blue hover:text-blue-darker" href="/threads/show?slug={{$comment['thread.slug']}}">{{ $comment['thread.title'] }}</a>'
                            </p>
                        </div>
                    </div>

                    <div class="mt-3">
                        <p>{{ nl2br($comment['content']) }}</p>
                    </div>

                    <div class="flex mt-5 text-grey-dark">
                        @if (auth()->check() && (auth()->user()->hasRole(['super', 'admin', 'moderator']) ||  auth()->user()->getId() == $comment['user.user_id']))
                            <div class="flex-1 self-center text-right text-xs hover:text-grey-darkest">
                                <button class="remove-comment px-3 text-grey hover:text-grey-darker text-xs font-bold" data-commentID="{{ $comment['comment_id'] }}">Remove</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection