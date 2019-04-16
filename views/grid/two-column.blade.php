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
                    <div class="container py-4 px-3">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection