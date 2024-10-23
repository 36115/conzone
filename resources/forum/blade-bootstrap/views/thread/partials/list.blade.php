<div class="list-group-item {{ $thread->pinned ? 'pinned' : '' }} {{ $thread->locked ? 'locked' : '' }} {{ $thread->trashed() ? 'deleted' : '' }}" :class="{ 'border-primary': state.selectedThreads.includes({{ $thread->id }}) }">
    <div class="row align-items-center p-2">
        <div class="col-8 mb-3 mb-sm-0">
            <div class="d-flex justify-content-start align-items-center">
                @if ($thread->pinned)
                    <span class="badge bg-info me-1 rounded-pill">
                        <i class="bi bi-pin-angle-fill"></i>
                        {{ trans('forum::threads.pinned') }}
                    </span>
                @endif

                @if ($thread->locked)
                    <span class="badge bg-warning me-1 rounded-pill">
                        <i class="bi bi-lock-fill"></i>
                        {{ trans('forum::threads.locked') }}
                    </span>
                @endif

                @if ($thread->userReadStatus !== null && !$thread->trashed())
                    <span class="badge bg-success mx-1 my-1 me-1 rounded-pill">
                        <i class="bi bi-eye-fill"></i>
                        {{ trans($thread->userReadStatus) }}
                    </span>
                @endif
                
                @if ($thread->trashed())
                    <span class="badge bg-danger me-1 rounded-pill">
                        <i class="bi bi-trash3-fill"></i>
                        {{ trans('forum::general.deleted') }}
                    </span>
                @endif
                
                <h6>
                    <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ Forum::route('thread.show', $thread) }}">{{ $thread->title }}</a>
                </h6>
            </div>
            <p class="text-muted small mb-2">Posted <i>@include ('forum::partials.timestamp', ['carbon' => $thread->created_at])</i> by <b><a href="{{ route('profile.show', $thread->author_id) }}" class="text-muted link-underline link-underline-opacity-0 link-underline-opacity-75-hover">{{ $thread->authorDisplayName }}</a></b></p>

            <div class="row text-muted my-2">
                {{-- <div class="col-2 d-flex align-items-center">
                    <i class="bi bi-bar-chart"></i>
                    <span class="small mx-1">0</span>
                </div> --}}
                <div class="col-2 d-flex align-items-center">
                    <i class="bi bi-chat"></i>
                    <span class="small mx-1">{{ $thread->reply_count }}</span>
                </div>
                {{-- <div class="col-2 d-flex align-items-center">
                    <i class="bi bi-eye"></i>
                    <span class="small mx-1">0</span>
                </div> --}}
            </div>

            @if (!isset($category))
                <div class="small text-muted">
                    Topic: <a class="text-muted me-2" href="{{ Forum::route('category.show', $thread->category) }}"><i>{{ $thread->category->title }}</i></a>
                </div>
            @endif

        </div>

        @if ($thread->lastPost)
            <div class="col text-md-end text-muted">
                <img class="rounded-circle @if (Request::is('topic/*')) me-2 @endif" style="height: 2rem; width: 2rem; background-color: var(--bs-border-color);" src="@if ($thread->authorProfileImage) {{ asset($thread->authorProfileImage) }} @else {{ 'https://ui-avatars.com/api/?name='. urlencode($thread->authorDisplayName) .'&background=random&bold=true' }} @if (!str_contains($thread->authorDisplayName, ' ')) &length=1 @endif @endif">
                <b><a href="{{ route('profile.show', $thread->author_id) }}" class="text-muted link-underline link-underline-opacity-0 link-underline-opacity-75-hover">{{ $thread->authorDisplayName }}</a></b>
                <br>
                <span class="text-muted"><span>@</span>{{ $thread->authorUserName }}</span>
                <br>
                <span class="text-muted">@include ('forum::partials.timestamp', ['carbon' => $thread->lastPost->created_at])</span>
                <br>
                <a href="{{ Forum::route('thread.show', $thread->lastPost) }}">{{ trans('forum::posts.view') }} &raquo;</a>
            </div>
        @endif

        @if (isset($category) && isset($selectableThreadIds) && in_array($thread->id, $selectableThreadIds))
            <div class="col" style="flex: 0; scale: 1.5;">
                <input class="form-check-input" type="checkbox" name="threads[]" :value="{{ $thread->id }}" v-model="state.selectedThreads">
            </div>
        @endif
    </div>
</div>
