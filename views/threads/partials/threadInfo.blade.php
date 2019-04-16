
<div class="flex flex-row justify-around self-start">
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