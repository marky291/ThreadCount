@extends('master')

@section('grid')
    <div class="w-full px-6 py-12 border-t">
        <div class="container mx-auto max-w-xl">
            <div class="flex mb-4">
                <div class="w-1/5">
                    <div id="sticker">
                        @include('sidebar')
                    </div>
                </div>
                <div class="w-5/6">
                    @if (auth()->check())
                        <div class=" text-grey text-xs flex flex-row px-6">
                            <div class="text-left flex-1">
                                {{ config('project.name') }} by {{ config('project.author') }} ({{ config('project.knumber') }})
                            </div>
                            <div class="text-right flex-1">
                                Your account last logged in {{ \Carbon\Carbon::createFromTimeString(auth()->user()->getLastLoginTime())->diffForHumans() }}
                            </div>
                        </div>
                    @endif
                    <div class="container py-4 px-3">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection