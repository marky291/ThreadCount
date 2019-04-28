@extends('grid.two-column')

@section('content')
    <div class="markdown mb-6 mx-auto border-l-4 border-blue pl-3">
        <h3 class="text-blue">{{ isset($thread) ? 'Thread Editor' : 'Thread Creator' }}</h3>
        <div class="text-l text-grey-dark mb-4">
            {{ isset($thread) ? 'Edit a previously created thread' : 'Open a new discussion of your chosen topic' }}
        </div>
    </div>

    <form class="w-full" id="create-thread-form" method="post" action="{{ isset($thread) ? '/threads/update' : '/threads/create' }}">
        @if (isset($thread))
            <input type="hidden" id="threadSlug" name="threadSlug" value="{{ $thread['slug'] }}">
        @endif
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 mb-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                    Title
                </label>
                <input name="title" class="appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3 px-4 border border-grey-lighter leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-first-name" type="text" value="{{ isset($thread) ? ucfirst($thread['title']) : null }}" placeholder="Preview of your content">
            </div>
            <div class="w-full px-3 mb-4">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
                    Content
                </label>
                <textarea name="content" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="" cols="30" rows="10" placeholder="Ask something interesting...">{{ isset($thread) ? ucfirst($thread['content']) : null }}</textarea>
            </div>
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
                    Topic
                </label>
                <div class="relative">
                    <select name="topicID" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-state">
                        @foreach ($topics as $topic)
                            <option value="{{ $topic['topic_id'] }}" {{ isset($thread) ? css_status($thread['topic.title'] == $topic['title']) : null }}>{{ $topic['title'] }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between float-right">
            <button id="cancel-button" class="text-xs bg-white text-blue w-full hover:bg-blue-dark border-blue-light border hover:text-white font-bold py-2 px-4 rounded-l">
                Cancel
            </button>
            <button class="text-xs bg-blue-light w-full hover:bg-blue-dark text-white font-bold border border-blue-light py-2 px-4 rounded-r" type="submit">
                {{ isset($thread) ? 'Update' : 'Post' }}
            </button>
        </div>
    </form>

    @push('scripts')
        <script>
            $("#cancel-button").click(function(event) {
                event.preventDefault();
                window.location.replace("/"); // return to homepage;
            });

            $("#create-thread-form").validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 35,
                    },
                    content: {
                        required: true,
                        minlength: 3,
                        maxlength: 255,
                    },
                    topic: {
                        required: true,
                    }
                }
            });
        </script>
    @endpush

@endsection