<div class="col-lg-3 mb-lg-0">
    <div class="sticky-top" style="top: 130px; z-index: 0;">
        @if (Request::is('/*'))
            @can ('createCategories')
                <button type="button" class="btn btn-lg btn-success mb-4 w-100 d-flex justify-content-evenly" data-open-modal="create-category">
                    <span class="bi bi-plus-lg"> {{ trans('forum::categories.create') }}</span>
                </button>
            @endcan
        @elseif (Request::is('topic/*'))
            @if ($category->accepts_threads)
                @can ('createThreads', $category)
                    <a href="{{ Forum::route('thread.create', $category) }}" class="btn btn-lg btn-success mb-4 w-100 rounded-pill d-flex justify-content-evenly"><span class="bi bi-plus-lg"> {{ trans('forum::threads.new_thread') }}</a>
                @endcan
            @endif
        @endif
        <div class="card mb-4">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h5 class="mb-0">Active Threads</h5>
            </div>
            <div class="card-body p-1">
                <ul class="list-group list-group-flush">
                    @php($i = 0)

                    @foreach ($threads as $thread) @if ($i < 3)
                        <li class="list-group-item  {{ $thread->pinned ? 'pinned' : '' }} {{ $thread->locked ? 'locked' : '' }} {{ $thread->trashed() ? 'deleted' : '' }}">
                            
                            <div class="d-block">
                                <div class="d-block my-1">
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
                                </div>

                                <h6 class="mb-1">
                                    <a href="{{ Forum::route('thread.show', $thread) }}" class="link-offset-2-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">{{ $thread->title }}</a>
                                </h6>
                            </div>

                            <small class="text-muted">Posted <i>@include ('forum::partials.timestamp', ['carbon' => $thread->created_at])</i> by <a href="{{ route('profile.show', $thread->author_id) }}" class="text-muted link-underline link-underline-opacity-0 link-underline-opacity-75-hover"><span>@</span>{{ $thread->authorUserName }}</a></small>

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
                        </li>
                        @php($i +=1)
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h5 class="mb-0">Stats</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        @php($k = 0)

                        @foreach ($categories as $category)
                            @php($k +=1)
                        @endforeach

                        <h3 class="mb-0">{{ $k }}</h3>
                        <small class="text-muted">Topics</small>
                    </div>
                    <div class="col-6 mb-3">
                        @php($j = 0)

                        @foreach ($threads as $thread)
                            @php($j +=1)
                        @endforeach
                        
                        <h3 class="mb-0">{{ $j }}</h3>
                        <small class="text-muted">Threads</small>
                    </div>
                    <div class="col-6">
                        <h3 class="mb-0">{{ $userCount }}</h3>
                        <small class="text-muted">Members</small>
                    </div>
                    <div class="col-6">
                        <h3 class="mb-0">
                            <a href="{{ route('profile.show', $newestUser->id) }}" class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover"><small>{{ $newestUser->displayname }}</small></a>
                        </h3>
                        <small class="text-muted">Newest Member</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (Request::is('/*'))
    @can ('createCategories')
        @include ('forum::category.modals.create')
    @endcan
@endif