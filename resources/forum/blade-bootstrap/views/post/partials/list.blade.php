<div class="card mb-3 shadow-sm" @if (!$post->trashed())id="post-{{ $post->sequence }}"@endif
    class="post card mb-2 {{ $post->trashed() || $thread->trashed() ? 'deleted' : '' }}"
    :class="{ 'border-primary': state.selectedPosts.includes({{ $post->id }}) }">
    <div class="card-header">
        @if (!isset($single) || !$single)
            <span class="float-end">
                <a href="{{ Forum::route('thread.show', $post) }}">#{{ $post->sequence }}</a>
                @if ($post->sequence != 1)
                    @can ('deletePosts', $post->thread)
                        @can ('delete', $post)
                            <input class="form-check-input ms-3" type="checkbox" name="posts[]" style="scale: 1.5;" :value="{{ $post->id }}" v-model="state.selectedPosts">
                        @endcan
                    @endcan
                @endif
            </span>
        @endif

        <div class="d-flex align-items-center">
            <div class="d-flex flex-column border-end pe-3 me-3">
                <div class="text-center mb-2">
                    <img src="@if ($post->authorProfileImage) {{ asset($post->authorProfileImage) }} @else {{ 'https://ui-avatars.com/api/?name='. urlencode($post->authorDisplayName) .'&background=random&bold=true' }} @if (!str_contains($post->authorDisplayName, ' ')) &length=1 @endif @endif" class="rounded-circle" style="width: 50px; height: 50px; background-color: var(--bs-border-color);">
                </div>
                @if ($post->authorRole == 'Admin')
                    <span class="badge text-bg-danger user-select-none rounded-pill"><i class="bi bi-hammer"></i> Admin</span>
                @elseif ($post->authorRole == 'Moderator')
                <span class="badge user-select-none rounded-pill" style="background-color: var(--bs-orange);"><i class="bi bi-person-fill-gear"></i> Staff</span>
                @else
                    <span class="badge text-bg-info user-select-none rounded-pill"><i class="bi bi-person-fill"></i> User</span>
                @endif
            </div>

            <div class="d-flex flex-row flex-column">
                <div class="d-flex">
                    <h5 class="me-1 mb-0"><a class="text-body link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ route('profile.show', $thread->author_id) }}">{{ $post->authorDisplayName }}</a></h5>
                    @if ($thread->authorUserName == $post->authorUserName)
                        <span class="badge user-select-none rounded-pill me-1" style="background-color: var(--bs-purple);">OP</span>
                    @endif
                    
                    @if (Auth::check())
                        @if ($post->authorUserName == Auth::user()->username)
                            <span class="badge text-bg-primary user-select-none rounded-pill">You</span>
                        @endif
                    @endif
                </div>

                <small class="text-muted mb-0"><span>@</span>{{ $post->authorUserName }} ({{ $post->authorRole }})</small>
                <small class="text-muted">
                    @include ('forum::partials.timestamp', ['carbon' => $post->created_at])

                    @if ($post->hasBeenUpdated())
                        | ({{ trans('forum::general.last_updated') }} @include ('forum::partials.timestamp', ['carbon' => $post->updated_at]))
                    @endif
                </small>
            </div>
        </div>
    </div>
    
    <div class="card-body">

        @if ($post->parent !== null)
            @include ('forum::post.partials.quote', ['post' => $post->parent])
        @endif

        <div class="post-content py-3">
            @if ($post->trashed())
                @can ('viewTrashedPosts')
                    @if (strlen($post->content) > 500)
                        <div class="short-content">
                            {!! Forum::render(substr($post->content, 0, 200)) !!}<span class="dots">...</span>
                        </div>
                        <div class="full-content" style="display: none;">
                            {!! Forum::render($post->content) !!}
                        </div>
                        <div class="text-end">
                            <button onclick="toggleContent(this)" class="btn btn-link p-0 mb-4">Read more</button>
                        </div>
                    @else
                        {!! Forum::render($post->content) !!}
                    @endif
                @endcan
                <span class="badge bg-danger rounded-pill">{{ trans('forum::general.deleted') }}</span>
            @else
                @if (strlen($post->content) > 500)
                    <div class="short-content">
                        {!! Forum::render(substr($post->content, 0, 200)) !!}<span class="dots">...</span>
                    </div>
                    <div class="full-content" style="display: none;">
                        {!! Forum::render($post->content) !!}
                    </div>
                    <div class="text-end">
                        <button onclick="toggleContent(this)" class="btn btn-link p-0 mb-4">Read more</button>
                    </div>
                @else
                    {!! Forum::render($post->content) !!}
                @endif
            @endif
        </div>
        @if (isset($single))
            <p class="d-flex justify-content-end"><a href="{{ Forum::route('thread.show', $thread) }}" class="btn btn-info rounded-pill"><i class="bi bi-box-arrow-up-right"></i> {{ trans('forum::threads.view') }}</a></p>
        @endif

        <div class="d-flex justify-content-between align-items-center">

            @if (!isset($single) || !$single)
                <div class="reactions">
                    {{-- <button class="btn btn-sm btn-outline-secondary me-2"><i class="bi bi-hand-thumbs-up"></i> Like</button> --}}

                    @can ('reply', $post->thread)
                        <a href="{{ Forum::route('post.create', $post) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-reply"></i> {{ trans('forum::general.reply') }}</a>
                    @endcan
                </div>
            @endif

            @if (!isset($single) || !$single)
                <div class="text-end">
                    @if (!$post->trashed())
                        <a href="{{ Forum::route('post.show', $post) }}" class="card-link text-muted">{{ trans('forum::general.permalink') }}</a>
                        @if ($post->sequence != 1)
                            @can ('deletePosts', $post->thread)
                                @can ('delete', $post)
                                    <a href="{{ Forum::route('post.confirm-delete', $post) }}" class="card-link text-danger">{{ trans('forum::general.delete') }}</a>
                                @endcan
                            @endcan
                        @endif
                        @can ('edit', $post)
                            <a href="{{ Forum::route('post.edit', $post) }}" class="card-link">{{ trans('forum::general.edit') }}</a>
                        @endcan
                    @else
                        @can ('restorePosts', $post->thread)
                            @can ('restore', $post)
                                <a href="{{ Forum::route('post.confirm-restore', $post) }}" class="card-link">{{ trans('forum::general.restore') }}</a>
                            @endcan
                        @endcan
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

@if (isset($single))
    <script>
        function toggleContent(button) {
            const contentDiv = button.closest('.post-content.py-3');
            const shortContent = contentDiv.querySelector('.short-content');
            const fullContent = contentDiv.querySelector('.full-content');

            if (fullContent.style.display === "none") {
                shortContent.style.display = "none";
                fullContent.style.display = "block";
                button.innerHTML = "Read less";
            } else {
                shortContent.style.display = "block";
                fullContent.style.display = "none";
                button.innerHTML = "Read more";
            }
        }
    </script>
@endif