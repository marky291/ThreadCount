@extends('grid.one-column')

@section('content')
    <div class="controller">
        <div class="row">
            <div class="col">
                <div class="flex">
                    <div class="flex-1 self-center">
                        <h2>{{ $message }}</h2>
                        <p class="text-right">404 Means you are in the wrong place.</p>
                    </div>
                    <div class="flex-1">
                        <img src="https://blog.hubspot.com/hs-fs/hubfs/css-tricks-404-page.png?width=954&height=766&name=css-tricks-404-page.png"
                             alt="404 page error skit.">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection