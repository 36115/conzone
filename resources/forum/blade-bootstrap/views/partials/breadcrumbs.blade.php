<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-body-tertiary border p-2 rounded-4">
        <li class="breadcrumb-item"><a class="link-underline link-underline-opacity-0" href="{{ url(config('forum.frontend.router.prefix')) }}"><i class="bi bi-house-fill"></i> {{ trans('forum::general.index') }}</a></li>
        @if (isset($category) && $category)
            @include ('forum::partials.breadcrumb-categories', ['category' => $category])
        @endif
        @if (isset($thread) && $thread)
            <li class="breadcrumb-item"><a class="link-underline link-underline-opacity-0" href="{{ Forum::route('thread.show', $thread) }}">{{ $thread->title }}</a></li>
        @endif
        @if (isset($breadcrumbs_append) && count($breadcrumbs_append) > 0)
            @foreach ($breadcrumbs_append as $breadcrumb)
                <li class="breadcrumb-item">{{ $breadcrumb }}</li>
            @endforeach
        @endif
    </ol>
</nav>
