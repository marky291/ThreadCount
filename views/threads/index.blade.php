@extends('grid.two-column')

@section('content')
   @if (count($threads) > 0)
       @foreach($threads as $thread)
           <div class="thread-item px-6 py-5 hover:bg-grey-lighter rounded flex justify-between items-center">
               <div class="rounded-full h-16 w-16 flex avatar-circle items-center justify-center mr-6 bg-grey"><img class="rounded-full avatar-circle" src="{{ $thread['avatar_url'] }}" alt=""></div>
               <div class="flex-1">
                   <h4 class="font-bold md:font-semibold mb-3 tracking-tight text-black hover:text-black"><a href="/threads/show?slug={{$thread['slug']}}" class="text-grey-darkest">{{ $thread['title'] }}</a></h4>
                   <p class="text-grey-dark text-xs"><span class="text-blue"><a title="View all threads created by {{ $thread['username'] }}" href="/threads/user?username={{ $thread['username'] }}">{{ $thread['username'] }}</a></span> posted at {{ $thread['created_at'] }}</p>
               </div>
               <div class="flex flex-row justify-around items-center">
                   <div class="mr-4">
                       <i class="fas fa-eye text-grey"></i> {{ $thread['count.views'] }}
                   </div>
                   <div class="mr-4">
                       <i class="fas fa-comment text-grey"></i> {{ $thread['count.comments'] }}
                   </div>
                   <div class="thread-{{strtolower($thread['topic.title'])}} w-28 text-center px-4 py-1 text-blue border border-blue rounded-full text-xs">
                       <a class="topic-title" href="/threads/topic?title={{ strtolower($thread['topic.title']) }}">{{ strtoupper($thread['topic.title']) }}</a>
                   </div>
               </div>
           </div>
       @endforeach
    @else
        <div class="flex flex-col items-center">
            <img src="https://ya-webdesign.com/images/vision-vector-colorful-2.png"
                 alt="A person searching" style="height:200px; width: 200px;">

            <h4 class="text-grey-darkest">Uh oh! There are no threads to be shown!</h4>
        </div>
    @endif
@endsection