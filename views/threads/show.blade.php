@extends('grid.two-column')

@section('content')
    <div class="thread-item px-6 py-8 hover:bg-grey-lightest rounded flex">
        <div class="">
            <div class="rounded-full h-16 w-16 flex avatar-circle items-center justify-center mr-6 bg-grey">
                <img class="rounded-full avatar-circle" src="//www.gravatar.com/avatar/c2d52abc9f91d455e15a48d59fecd746?s=100&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fdefault-square-avatar.jpg" alt="">
            </div>
        </div>
        <div class="flex-1">
            <div class="flex justify-between">
                <div class="flex-1">
                    @include('threads.partials.userInfo', ['username' => $thread['username'], 'created_at' => $thread['created_at']])
                </div>
                @include('threads.partials.threadInfo', ['thread' => $thread])
            </div>

            <div class="thread-title bg-blue-lightest px-6 py-4 rounded mt-5 mb-2 md:mb-6 text-black-transparent-75">
                <h4>{{ $thread['title'] }}</h4>
            </div>

            <div class="mt-3">
                <p>{{ $thread['content'] }}</p>
            </div>
        </div>
    </div>


    @foreach ($comments as $comment)
        <div class="thread-item px-6 py-8 hover:bg-grey-lightest rounded flex">
            <div class="">
                <div class="rounded-full h-16 w-16 flex avatar-circle items-center justify-center mr-6 bg-grey">
                    <img class="rounded-full avatar-circle" src="//www.gravatar.com/avatar/c2d52abc9f91d455e15a48d59fecd746?s=100&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fdefault-square-avatar.jpg" alt="">
                </div>
            </div>
            <div class="flex-1">
                <div class="flex justify-between">
                    <div class="flex-1">
                        @include('threads.partials.userInfo', ['username' => $comment['user.username'], 'created_at' => $comment['created_at']])
                    </div>
                </div>

                <div class="mt-3">
                    <p>{{ nl2br($comment['content']) }}</p>
                </div>

                <div class="flex mt-5 text-grey-dark">
                    <div class="flex-1 text-left">
                        <i class="fas fa-heart mr-1"></i> {{ $comment['karma_score'] }}
                    </div>
                    @if (auth()->check() && (auth()->user()->hasRole(['super', 'admin', 'moderator']) ||  auth()->user()->getId() == $comment['user.user_id']))
                        <div class="flex-1 text-right text-xs hover:text-grey-darkest">
                            <button class="remove-comment text-red border border-red p-1 hover:bg-red hover:text-white rounded-l rounded-r" data-commentID="{{ $comment['comment_id'] }}">Remove Comment</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <div id="comment-reply" class="mt-4 create-reply flex items-center rounded cursor-pointer border border-dashed hover:border-blue focus:border-blue">
        <div class="p-8 flex w-full items-center">
            <div class="rounded-full h-16 w-16 flex avatar-circle items-center justify-center mr-6 bg-grey">
                <img class="rounded-full avatar-circle" src="//www.gravatar.com/avatar/c2d52abc9f91d455e15a48d59fecd746?s=100&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fdefault-square-avatar.jpg" alt="">
            </div>
            <p id="reply-brief" class="text-grey-darkest">Write a new reply.</p>

            <span id="reply-action" class="w-full hidden">
                <p>Reply to <span class="text-blue">Conversation</span></p>
                <textarea class="w-full my-4 focus:outline-none" name="comment" id="comment" cols="30" rows="10" placeholder="Write something nice..."></textarea>
                <button id="submit-comment" class="text-left text-xs bg-blue-light w-full hover:bg-blue-dark text-white font-bold py-2 px-4 rounded-r rounded-l">
                    Commit my reply
                </button>
            </span>

        </div>
    </div>

    @push('scripts')
        <script>
            $(document).mouseup(function(e)
            {
                let reply = $("#comment-reply");

                if (!reply.is(e.target) && reply.has(e.target).length === 0)
                {
                    console.log("Clicked outside box.");
                    $("#reply-brief").removeClass("hidden");
                    $("#reply-action").addClass("hidden");
                }
                else
                {
                    $("#reply-brief").addClass("hidden");
                    $("#reply-action").removeClass("hidden");
                    $("#comment").focus();
                }
            });

            $("#submit-comment").click(function() {
                let inputText = $("#reply-action #comment");

                $.post( "/comments/store", { threadID: "{{ $thread['thread_id'] }}", commentText: inputText.val() })
                    .done(function( data ) {
                            inputText.val("");
                            $("#reply-brief").removeClass("hidden");
                            $("#reply-action").addClass("hidden");
                            $("#reply-brief").addClass("text-green-dark font-bold").text("You successfully created a reply!... Reloading");
                            setTimeout(function() {
                                location.reload();
                            }, 0);
                    }
                );
            });

            $(".remove-comment").click(function() {
                console.log($(".remove-comment").attr("data-commentid"));
                $.post("/comments/destroy", {commentID: $(".remove-comment").attr("data-commentid")})
                    .fail(function(data) {
                        console.log(data);
                    })
                    .done(function() {
                        $("this").parent("thread-item").hide();
                        location.reload();
                    });
            });
        </script>
    @endpush

@endsection

