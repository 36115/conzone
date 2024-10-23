<div class="list-group-item {{ $thread->pinned ? 'pinned' : '' }} {{ $thread->locked ? 'locked' : '' }} {{ $thread->trashed() ? 'deleted' : '' }}" :class="{ 'border-primary': state.selectedThreads.includes({{ $thread->id }}) }">
    <div class="row align-items-center text-center">
        <div class="col-sm text-md-start">
            <span class="lead">
                <a href="{{ Forum::route('thread.show', $thread) }}" @if (isset($category))style="color: {{ $category->color_light_mode }};"@endif>{{ $thread->title }}</a>
            </span>
            <br>
            {{ $thread->authorUserName }} <span class="text-muted">@include ('forum::partials.timestamp', ['carbon' => $thread->created_at])</span>

            @if (!isset($category))
                <br>
                <a href="{{ Forum::route('category.show', $thread->category) }}" style="color: {{ $thread->category->color_light_mode }};">{{ $thread->category->title }}</a>
            @endif
        </div>
        <div class="col-sm text-md-end">
            @if ($thread->pinned)
                <span class="badge rounded-pill bg-info">{{ trans('forum::threads.pinned') }}</span>
            @endif
            @if ($thread->locked)
                <span class="badge rounded-pill bg-warning">{{ trans('forum::threads.locked') }}</span>
            @endif
            @if ($thread->userReadStatus !== null && !$thread->trashed())
                <span class="badge rounded-pill bg-success">{{ trans($thread->userReadStatus) }}</span>
            @endif
            @if ($thread->trashed())
                <span class="badge rounded-pill bg-danger">{{ trans('forum::general.deleted') }}</span>
            @endif
            <span class="badge rounded-pill bg-primary" @if (isset($category))style="background: {{ $category->color_light_mode }};"@endif>
                {{ trans('forum::general.replies') }}:
                {{ $thread->reply_count }}
            </span>
        </div>

        @if ($thread->lastPost)
            <div class="col-sm text-md-end text-muted">
                <a href="{{ Forum::route('thread.show', $thread->lastPost) }}">{{ trans('forum::posts.view') }} &raquo;</a>
                <br>
                {{ $thread->lastPost->authorUserName }}
                <span class="text-muted">@include ('forum::partials.timestamp', ['carbon' => $thread->lastPost->created_at])</span>
            </div>
        @endif

        @if (isset($category) && isset($selectableThreadIds) && in_array($thread->id, $selectableThreadIds))
            <div class="col-sm" style="flex: 0;">
                <input type="checkbox" name="threads[]" :value="{{ $thread->id }}" class="form-check-input" v-model="state.selectedThreads">
            </div>
        @endif
    </div>
</div>
