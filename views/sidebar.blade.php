<div class="sidebar container py-4 overflow-y-auto text-base lg:text-sm lg:pl-6 lg:pr-8 sticky?lg:h-(screen-16)">
    <div class="mb-8">
        <h2 class="mb-3 lg:mb-2 text-grey uppercase tracking-wide font-bold text-sm lg:text-xs">Topics</h2>
        <ul class="list-reset">
            <li class="mb-3 lg:mb-2">
                <a class="hover:underline text-grey-darkest {{ css_status(isCurrentUri('/threads')) }}" href="/threads" title="All threads sorted by creation date">All Threads</a>
            </li>
            @foreach(App\Models\Topics::all() as $topic)
                <li class="mb-3 lg:mb-2">
                    <a class="hover:underline text-grey-darkest {{ css_status(hasQueryString('title', strtolower($topic['title'])))  }}" href="/threads/topic?title={{strtolower($topic['title'])}}" title="{{$topic['description']}}">{{$topic['title']}}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="mb-8">
        <h2 class="mb-3 lg:mb-2 text-grey uppercase tracking-wide font-bold text-sm lg:text-xs">Threads</h2>
        <ul class="list-reset">
            @if (auth()->check())
                <li class="mb-3 lg:mb-2">
                    <a class="hover:underline text-grey-darkest" href="/threads/user?username={{ auth()->user()->getUsername() }}">My Threads</a>
                </li>
            @endif
        </ul>
    </div>
    @if (auth()->check())
    <button class="text-xs bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded-full">
        New Thread
    </button>
    @endif
</div>