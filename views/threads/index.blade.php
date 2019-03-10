@extends('master')

@section('content')
    <div class="w-full px-6 py-12 border-t">
        <div class="container mx-auto max-w-xl">
            <div class="flex mb-4">
                <div class="w-1/5">
                    <div class="sidebar container py-4 px-3">
                        <div class="block">
                            <h2>Topics</h2>
                            <ul class="list-reset">
                                @foreach($topics as $topic)
                                    <li><a href="/threads?topic={{strtolower($topic['title'])}}" title="{{$topic['description']}}">{{$topic['title']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="block">
                            <h2>Threads</h2>
                            <ul class="list-reset">
                                <li><a href="">My Threads</a></li>
                                <li><a href="">Popular Threads</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-4/5">
                    <div class="container py-4 px-3">
                        @foreach($threads as  $thread)
                            <div class="thread-item px-6 py-4 hover:bg-grey-lighter rounded flex justify-between cursor-pointer">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-base">{{ $thread['title'] }}</h4>
                                    <p class="text-base truncate text-grey-darkest"><span class="text-blue">{{ $thread['username'] }}</span> posted at {{ $thread['created_at'] }}</p>
                                </div>
                                <div class="flex flex-row justify-around items-center">
                                    <div class="mr-4">
                                        <i class="fas fa-eye text-grey"></i> {{ $thread['count.views'] }}
                                    </div>
                                    <div class="mr-4">
                                        <i class="fas fa-comment text-grey"></i> {{ $thread['count.comments'] }}
                                    </div>
                                    <div class="px-4 py-1 text-blue border border-blue rounded-full text-xs">
                                        {{ strtoupper($thread['topic.title']) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection