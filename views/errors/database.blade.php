@extends('grid.one-column')

@section('content')
    <div class="controller">
        <div class="row">
            <div class="col">
                <div class="flex">
                    <div class="flex-1 self-center">
                        <h2>{{ $message }}</h2>
                        <p class="text-right">Database broke. Luckily its only college.</p>
                    </div>
                    <div class="flex-1">
                        <img src="https://png2.kisspng.com/sh/42043399325d2181f7cd894613b0566a/L0KzQYm3VsA1N5pnhJH0aYP2gLBuTfZtd6F1kZ9taYPuPbXwkBsue6V0itNwZT3mf773gfN1NZVui9U2aHH1dH7rkvl3baQyfNt8a3X3hLa0VfIyPZM4Stc7Mke0SYW1VcEyOGg8SKM6NUK7QYWBV8gzOWU2SZD5bne=/kisspng-floppy-disk-disk-storage-compact-disc-hard-drives-diskette-5b15b32e227194.5110770115281487821411.png"
                             alt="database page error skit.">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection