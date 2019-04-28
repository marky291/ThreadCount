@extends('grid.two-column')

@section('content')

   @if (count($threads) > 0)
       <div id="threadContainer">
           @foreach($threads as $thread)
               @php($viewedThreads = auth()->check() ? \App\Models\Threads::collectAllViewedBy(auth()->user()->getId())->toArray() : [])
               <div class="thread-item px-6 py-5 hover:bg-grey-lighter rounded flex justify-between items-center">
                   <div class="rounded-full h-16 w-16 flex avatar-circle items-center justify-center mr-6 bg-grey">
                       @if (auth()->check() && (auth()->user()->getUsername() == $thread['username']  || auth()->user()->hasRole(['super', 'admin', 'moderator'])))
                           <a href="/profile/update?username={{ $thread['username'] }}">
                               <img class="border hover:border-solid hover:border-grey hover:shadow rounded-full avatar-circle" src="//www.gravatar.com/avatar/c2d52abc9f91d455e15a48d59fecd746?s=100&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fdefault-square-avatar.jpg" alt="">
                           </a>
                       @else
                           <img class="rounded-full avatar-circle" src="//www.gravatar.com/avatar/c2d52abc9f91d455e15a48d59fecd746?s=100&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fdefault-square-avatar.jpg" alt="">
                       @endif
                   </div>
                   <div class="flex-1">
                       <h4 class="font-bold md:font-semibold mb-3 tracking-tight text-black hover:text-black">
                           <a href="/threads/show?slug={{$thread['slug']}}" class="text-grey-darkest">{{ ucwords($thread['title']) }}</a>
                       </h4>
                       <p class="text-grey-dark text-xs">
                           <span class="text-blue uppercase">
                               <a class="text-blue font-bold" title="View all threads created by {{ ucwords($thread['username']) }}" href="/threads/user?username={{ $thread['username'] }}">{{ $thread['username']}}</a>
                           </span>
                           posted <span class="font-bold text-grey-dark">{{ Carbon\Carbon::createFromTimestamp(strtotime($thread['created_at']))->diffForHumans() }}</span>
                       </p>
                   </div>
                   @include('threads.partials.threadInfo', ['thread' => $thread, 'hasViewed' => in_array($thread['thread_id'], $viewedThreads, true)])
               </div>
           @endforeach
       </div>
    @else
        <div class="flex flex-col items-center">
            <img src="https://ya-webdesign.com/images/vision-vector-colorful-2.png"
                 alt="A person searching" style="height:200px; width: 200px;">

            <h4 class="text-grey-darkest">Uh oh! There are no threads to be shown!</h4>
        </div>
    @endif
@endsection