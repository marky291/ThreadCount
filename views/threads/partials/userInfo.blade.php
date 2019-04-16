<p class="text-base truncate text-grey-darkest">
    <span class="text-blue">
        <a class="font-bold text-blue" title="View all threads created by {{ $username }}" href="/threads/user?username={{ $username }}">
            {{ ucfirst($username) }}
        </a>
    </span>
    ∙ {{ Carbon\Carbon::createFromTimestamp(strtotime($created_at))->diffForHumans() }}
</p>