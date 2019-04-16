<header class="w-full px-6 bg-white">
    <div class="container mx-auto max-w-xl md:flex justify-between items-center">
        <a href="/" class="block py-6 w-full text-center md:text-left md:w-auto text-grey-dark no-underline flex justify-center items-center">
            <img src="/images/logo.png" alt="">
        </a>
        <div class="w-full md:w-auto mb-6 md:mb-0 text-center md:text-right">
            @if (!auth()->check())
                <a href="/auth/login" class="inline-block no-underline bg-black text-white text-sm py-2 px-3">Login</a>
                <a href="/auth/register" class="inline-block no-underline bg-black text-white text-sm py-2 px-3">Register</a>
            @else
                <a href="/auth/logout" class="inline-block no-underline bg-black text-white text-sm py-2 px-3">Logout {{ auth()->user()->getUsername() }}</a>
            @endif
        </div>
    </div>
</header>

<nav class="w-full bg-white md:pt-0 px-6 relative z-20 border-t border-b border-grey-light">
    <div class="container mx-auto max-w-xl md:flex justify-between items-center text-sm md:text-md md:justify-start">
        <div class="w-full md:w-1/2 text-center md:text-left py-4 flex flex-wrap justify-center items-stretch md:justify-start md:items-start">
            <a href="/threads" class="px-2 md:pl-0 md:mr-3 md:pr-3 text-grey-darker no-underline md:border-r border-grey-light {{ css_status(isCurrentUri('/threads') || isCurrentUri('/')) }}">All</a>
            @foreach(App\Models\Topics::all() as $topic)
                <a href="/threads/topic?title={{strtolower($topic['title'])}}" class="px-2 md:pl-0 md:mr-3 md:pr-3 text-grey-darker {{ hasQueryString('title', strtolower($topic['title'])) ?  'selected' : 'not-selected'  }} no-underline md:border-r border-grey-light">{{$topic['title']}}</a>
            @endforeach
        </div>
        <div class="w-full md:w-1/2 text-center md:text-right pb-4 md:p-0">
            <form action="/threads/search" method="get">
                <input type="search" name="query" placeholder="Search..." class="bg-grey-lighter border text-sm p-1" />
            </form>
        </div>
    </div>
</nav>
