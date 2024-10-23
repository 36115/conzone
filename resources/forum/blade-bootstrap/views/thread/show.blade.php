@extends ('forum::layouts.main', ['thread' => null, 'breadcrumbs_append' => [$thread->title], 'thread_title' => $thread->title])
@section('page') Thread @endsection
@section ('content')
    @if (Auth::check())
        @if ($thread->authorUserName == Auth::user()->username || Auth::user()->role == "Admin" || Auth::user()->role == "Moderator")
            <div class="card p-3 d-flex justify-content-center mb-4">
                @if (Gate::allows('deleteThreads', $category))
            
                    <h4 class="text-center">Thread Action</h4>
                    
                    <div class="btn-group d-flex flex-column flex-lg-row mb-2" role="group">
                        @if (Gate::allows('deleteThreads', $thread->category) && Gate::allows('delete', $thread))
                            @if ($thread->trashed())
                                <a href="#" class="btn btn-danger m-1 me-lg-1 m-lg-0 rounded-pill" data-open-modal="perma-delete-thread">
                                    <i data-feather="trash"></i> {{ trans('forum::general.perma_delete') }}
                                </a>
                            @else
                                <a href="#" class="btn btn-danger m-1 me-lg-1 m-lg-0 rounded-pill" data-open-modal="delete-thread">
                                    <i data-feather="trash"></i> {{ trans('forum::general.delete') }}
                                </a>
                            @endif
                        @endif
                        @if ($thread->trashed() && Gate::allows('restoreThreads', $thread->category) && Gate::allows('restore', $thread))
                            <a href="#" class="btn btn-secondary m-1 me-lg-1 m-lg-0 rounded-pill" data-open-modal="restore-thread">
                                <i data-feather="refresh-cw"></i> {{ trans('forum::general.restore') }}
                            </a>
                        @endif

                        @if (Gate::allows('lockThreads', $category)
                            || Gate::allows('pinThreads', $category)
                            || Gate::allows('rename', $thread)
                            || Gate::allows('moveThreadsFrom', $category))
                                @if (!$thread->trashed())
                                    @can ('lockThreads', $category)
                                        @if ($thread->locked)
                                            <a href="#" class="btn btn-secondary m-1 me-lg-1 m-lg-0 rounded-pill" data-open-modal="unlock-thread">
                                                <i data-feather="unlock"></i> {{ trans('forum::threads.unlock') }}
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-secondary m-1 me-lg-1 m-lg-0 rounded-pill" data-open-modal="lock-thread">
                                                <i data-feather="lock"></i> {{ trans('forum::threads.lock') }}
                                            </a>
                                        @endif
                                    @endcan
                                    @can ('pinThreads', $category)
                                        @if ($thread->pinned)
                                            <a href="#" class="btn btn-secondary m-1 me-lg-1 m-lg-0 rounded-pill" data-open-modal="unpin-thread">
                                                <i data-feather="arrow-down"></i> {{ trans('forum::threads.unpin') }}
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-secondary m-1 me-lg-1 m-lg-0 rounded-pill" data-open-modal="pin-thread">
                                                <i data-feather="arrow-up"></i> {{ trans('forum::threads.pin') }}
                                            </a>
                                        @endif
                                    @endcan
                                    @can ('rename', $thread)
                                        <a href="#" class="btn btn-secondary m-1 me-lg-1 m-lg-0 rounded-pill" data-open-modal="rename-thread">
                                            <i data-feather="edit-2"></i> {{ trans('forum::general.rename') }}
                                        </a>
                                    @endcan
                                    @can ('moveThreadsFrom', $category)
                                        <a href="#" class="btn btn-secondary m-1 me-lg-1 m-lg-0 rounded-pill" data-open-modal="move-thread">
                                            <i data-feather="corner-up-right"></i> {{ trans('forum::general.move') }}
                                        </a>
                                    @endcan
                                @endif
                            </div>
                        @endcan
                    </div>
                @endif
        @endif
    @endif

    <div id="thread">

        {{-- <div class="row mb-3">
            <div class="col col-xs-8">
                {{ $posts->links('forum::pagination') }}
            </div>
        </div> --}}

        @foreach ($posts as $post)

            @if ($post->sequence == 1)
                <div class="card mb-4 shadow-sm" @if (!$post->trashed())id="post-{{ $post->sequence }}"@endif
    class="post card mb-2 {{ $post->trashed() || $thread->trashed() ? 'deleted' : '' }}"
    :class="{ 'border-primary': state.selectedPosts.includes({{ $post->id }}) }">
                    <div class="card-body">
                        <div class="mt-2 mb-2">
                            @if ($thread->trashed())
                                <span class="badge bg-danger me-1 rounded-pill">
                                    <i class="bi bi-trash3-fill"></i>
                                    {{ trans('forum::general.deleted') }}
                                </span>
                            @endif
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
                        </div>

                        <h2 class="card-title">
                            {{ $thread->title }}
                        </h2>
                        
                        <div class="small text-muted mb-3">
                            Topic: <a class="text-muted me-2" href="{{ Forum::route('category.show', $thread->category) }}"><i>{{ $thread->category->title }}</i></a>
                        </div>

                        @if ($post->parent !== null)
                            @include ('forum::post.partials.quote', ['post' => $post->parent])
                        @endif

                        <div class="post-content">
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
                                            <button onclick="toggleContent(this)" class="btn btn-link p-0">Read more</button>
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
                                        <button onclick="toggleContent(this)" class="btn btn-link p-0">Read more</button>
                                    </div>
                                @else
                                    {!! Forum::render($post->content) !!}
                                @endif
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="my-3">
                                {{-- <button class="btn btn-outline-primary me-2 my-1"><i class="bi bi-hand-thumbs-up"></i> Like</button> --}}
                                <span id="copy"></span>
                            </div>
                            <div class="text-muted d-lg-block d-flex flex-column">
                                {{-- <span class="me-3"><i class="bi bi-bar-chart"></i> 0 Votes</span> --}}
                                <span class="me-3"><i class="bi bi-chat"></i> {{ $thread->reply_count }} Replies</span>
                                {{-- <span><i class="bi bi-eye"></i> 0 Views</span> --}}
                            </div>
                        </div>
                        <hr>
                        <div class="bg-body-tertiary rounded-4">
                            <div class="p-3 pb-0">

                                <div class="d-lg-flex justify-content-lg-between align-items-lg-center">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="@if ($post->authorProfileImage) {{ asset($post->authorProfileImage) }} @else {{ 'https://ui-avatars.com/api/?name='. urlencode($post->authorDisplayName) .'&background=random&bold=true' }} @if (!str_contains($post->authorDisplayName, ' ')) &length=1 @endif @endif" class="rounded-circle me-3" style="width: 50px; height: 50px; background-color: var(--bs-border-color);">
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('profile.show', $thread->author_id) }}" class="h4 mb-0 text-primary link-underline link-underline-opacity-0 link-underline-opacity-75-hover">{{ $post->authorDisplayName }}</a>
                                            <small class="text-muted"><span>@</span>{{ $post->authorUserName }} ({{ $post->authorRole }})</small>
                                        </div>
                                    </div>

                                    @if (!isset($single) || !$single)
                                        <div class="d-lg-flex justify-content-lg-end align-items-lg-center">
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
                                                @can ('reply', $post->thread)
                                                    <a href="{{ Forum::route('post.create', $post) }}" class="card-link">{{ trans('forum::general.reply') }}</a>
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

                                <div class="text-muted small mt-0 pb-2">
                                    Posted: <i>@include ('forum::partials.timestamp', ['carbon' => $post->created_at])</i>
                                    <br>
                                    @if ($post->hasBeenUpdated())
                                        ({{ trans('forum::general.last_updated') }}: @include ('forum::partials.timestamp', ['carbon' => $post->updated_at]))
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h3>{{ trans('forum::general.quick_reply') }}</h3>

                @if (!$thread->trashed())
                    @if (Auth::check())
                        @can ('reply', $thread)
                            <div class="card mb-4 shadow-sm" id="quick-reply">
                                <div class="card-body">
                                    <form method="POST" action="{{ Forum::route('post.store', $thread) }}">
                                        @csrf

                                        <div class="mb-3">
                                            <textarea name="content" class="form-control" rows="5" placeholder="Write a comment...">{{ old('content') }}</textarea>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary rounded-pill px-5">{{ trans('forum::general.reply') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endcan
                    @else
                        <div class="card p-2 mb-4 shadow-sm">
                            <div class="text-center">
                                <h5 class="p-3 pb-2 text-muted fw-normal">You need to login to reply this thread</h5>
                                <a href="{{ route('login') }}" class="btn btn-primary text-center rounded-pill px-5">Login</a>
                                <p class="fw-light mt-3">Don't have an account? <a href="{{ route('register') }}" class="text-primary">Register Now</a></p>
                            </div>
                        </div>
                    @endif
                @endif

                @continue
            @endif

            @if ($post->sequence == 2)
                @if ((count($posts) > 1 || $posts->currentPage() > 1) && (Gate::allows('deletePosts', $thread) || Gate::allows('restorePosts', $thread)) && count($selectablePosts) > 0)
                    <form :action="postActions[state.selectedPostAction]" method="POST">
                        @csrf
                        <input type="hidden" name="_method" :value="postActionMethods[state.selectedPostAction]" />
                @endif

                @if ((count($posts) > 1 || $posts->currentPage() > 1) && (Gate::allows('deletePosts', $thread) || Gate::allows('restorePosts', $thread)) && count($selectablePosts) > 0)
                    <div class="d-flex justify-content-end pt-2 pb-3">
                        <div class="form-check">
                            <label for="selectAllPosts">
                                {{ trans('forum::posts.select_all') }}
                            </label>
                            <input type="checkbox" value="" id="selectAllPosts" class="form-check-input" @click="toggleAll" :checked="state.selectedPosts.length == posts.data.length">
                        </div>
                    </div>
                @endif
            @endif

            @include ('forum::post.partials.list', compact('post'))
        @endforeach

        @if ((count($posts) > 1 || $posts->currentPage() > 1) && (Gate::allows('deletePosts', $thread) || Gate::allows('restorePosts', $thread)) && count($selectablePosts) > 0)
            <div class="position-fixed pb-xs-0 pr-xs-0 pb-sm-3 pr-sm-3" style="bottom: 0; right: 0; z-index: 1020;">
                <transition name="fade">
                    <div class="card bg-body-tertiary shadow-sm" v-if="state.selectedPosts.length">
                        <div class="card-header text-center">
                            {{ trans('forum::general.with_selection') }}
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text border bg-body-secondary rounded-start-pill rounded-end-0" for="bulk-actions">{{ trans_choice('forum::general.actions', 1) }}</label>
                                </div>
                                <select class="custom-select rounded-end-pill" id="bulk-actions" v-model="state.selectedPostAction">
                                    <option value="delete">{{ trans('forum::general.delete') }}</option>
                                    @if (config('forum.general.soft_deletes'))
                                        <option value="restore">{{ trans('forum::general.restore') }}</option>
                                    @endif
                                </select>
                            </div>

                            @if (config('forum.general.soft_deletes'))
                                <div class="form-check mb-3" v-if="state.selectedPostAction == 'delete'">
                                    <input class="form-check-input" type="checkbox" name="permadelete" value="1" id="permadelete">
                                    <label class="form-check-label" for="permadelete">
                                        {{ trans('forum::general.perma_delete') }}
                                    </label>
                                </div>
                            @endif

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary rounded-pill" @click="submitPosts">{{ trans('forum::general.proceed') }}</button>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </form>
        @endif

        {{ $posts->links('forum::pagination') }}
    </div>

    @if ($thread->trashed() && Gate::allows('restoreThreads', $thread->category) && Gate::allows('restore', $thread))
        @component('forum::modal-form')
            @slot('key', 'restore-thread')
            @slot('title', '<i data-feather="refresh-cw" class="text-muted"></i>' . trans('forum::general.restore'))
            @slot('route', Forum::route('thread.restore', $thread))
            @slot('method', 'POST')

            {{ trans('forum::general.generic_confirm') }}

            @slot('actions')
                <button type="submit" class="btn btn-primary rounded-pill">{{ trans('forum::general.proceed') }}</button>
            @endslot
        @endcomponent
    @endif

    @if (Gate::allows('deleteThreads', $thread->category) && Gate::allows('delete', $thread))
        @component('forum::modal-form')
            @slot('key', 'delete-thread')
            @slot('title', '<i data-feather="trash" class="text-muted"></i>' . trans('forum::threads.delete'))
            @slot('route', Forum::route('thread.delete', $thread))
            @slot('method', 'DELETE')

            @if (config('forum.general.soft_deletes'))
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permadelete" value="1" id="permadelete">
                    <label class="form-check-label" for="permadelete">
                        {{ trans('forum::general.perma_delete') }}
                    </label>
                </div>
            @else
                {{ trans('forum::general.generic_confirm') }}
            @endif

            @slot('actions')
                <button type="submit" class="btn btn-danger rounded-pill">{{ trans('forum::general.proceed') }}</button>
            @endslot
        @endcomponent

        @if (config('forum.general.soft_deletes'))
            @component('forum::modal-form')
                @slot('key', 'perma-delete-thread')
                @slot('title', '<i data-feather="trash" class="text-muted"></i>' . trans_choice('forum::threads.perma_delete', 1))
                @slot('route', Forum::route('thread.delete', $thread))
                @slot('method', 'DELETE')

                <input type="hidden" name="permadelete" value="1" />

                {{ trans('forum::general.generic_confirm') }}

                @slot('actions')
                    <button type="submit" class="btn btn-danger rounded-pill">{{ trans('forum::general.proceed') }}</button>
                @endslot
            @endcomponent
        @endif
    @endif

    @if (!$thread->trashed())
        @can ('lockThreads', $category)
            @if ($thread->locked)
                @component('forum::modal-form')
                    @slot('key', 'unlock-thread')
                    @slot('title', '<i data-feather="unlock" class="text-muted"></i> ' . trans('forum::threads.unlock'))
                    @slot('route', Forum::route('thread.unlock', $thread))
                    @slot('method', 'POST')

                    {{ trans('forum::general.generic_confirm') }}

                    @slot('actions')
                        <button type="submit" class="btn btn-primary rounded-pill">{{ trans('forum::general.proceed') }}</button>
                    @endslot
                @endcomponent
            @else
                @component('forum::modal-form')
                    @slot('key', 'lock-thread')
                    @slot('title', '<i data-feather="lock" class="text-muted"></i> ' . trans('forum::threads.lock'))
                    @slot('route', Forum::route('thread.lock', $thread))
                    @slot('method', 'POST')

                    {{ trans('forum::general.generic_confirm') }}

                    @slot('actions')
                        <button type="submit" class="btn btn-primary rounded-pill">{{ trans('forum::general.proceed') }}</button>
                    @endslot
                @endcomponent
            @endif
        @endcan

        @can ('pinThreads', $category)
            @if ($thread->pinned)
                @component('forum::modal-form')
                    @slot('key', 'unpin-thread')
                    @slot('title', '<i data-feather="arrow-down" class="text-muted"></i> ' . trans('forum::threads.unpin'))
                    @slot('route', Forum::route('thread.unpin', $thread))
                    @slot('method', 'POST')

                    {{ trans('forum::general.generic_confirm') }}

                    @slot('actions')
                        <button type="submit" class="btn btn-primary rounded-pill">{{ trans('forum::general.proceed') }}</button>
                    @endslot
                @endcomponent
            @else
                @component('forum::modal-form')
                    @slot('key', 'pin-thread')
                    @slot('title', '<i data-feather="arrow-up" class="text-muted"></i> ' . trans('forum::threads.pin'))
                    @slot('route', Forum::route('thread.pin', $thread))
                    @slot('method', 'POST')

                    {{ trans('forum::general.generic_confirm') }}

                    @slot('actions')
                        <button type="submit" class="btn btn-primary rounded-pill">{{ trans('forum::general.proceed') }}</button>
                    @endslot
                @endcomponent
            @endif
        @endcan

        @can ('rename', $thread)
            @component('forum::modal-form')
                @slot('key', 'rename-thread')
                @slot('title', '<i data-feather="edit-2" class="text-muted"></i> ' . trans('forum::general.rename'))
                @slot('route', Forum::route('thread.rename', $thread))
                @slot('method', 'POST')

                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-body-secondary rounded-start-pill rounded-end-0" for="new-title">{{ trans('forum::general.title') }}</label>
                    </div>
                    <input type="text" name="title" value="{{ $thread->title }}" class="form-control">
                </div>

                @slot('actions')
                    <button type="submit" class="btn btn-primary rounded-pill">{{ trans('forum::general.proceed') }}</button>
                @endslot
            @endcomponent
        @endcan

        @can ('moveThreadsFrom', $category)
            @component('forum::modal-form')
                @slot('key', 'move-thread')
                @slot('title', '<i data-feather="corner-up-right" class="text-muted"></i> ' . trans('forum::general.move'))
                @slot('route', Forum::route('thread.move', $thread))
                @slot('method', 'POST')

                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-body-secondary rounded-start-pill rounded-end-0" for="category-id">{{ trans_choice('forum::categories.category', 1) }}</label>
                    </div>
                    <select name="category_id" id="category-id" class="form-select rounded-end-pill">
                        @include ('forum::category.partials.options', ['hide' => $thread->category])
                    </select>
                </div>

                @slot('actions')
                    <button type="submit" class="btn btn-primary rounded-pill">{{ trans('forum::general.proceed') }}</button>
                @endslot
            @endcomponent
        @endcan
    @endif

    <script type="module">
    Vue.createApp({
        setup() {
            let posts = @json($posts);
            posts.data = posts.data.filter(post => post.sequence > 1);

            const selectablePosts = @json($selectablePosts);
            const postActions = {
                delete: "{{ Forum::route('bulk.post.delete') }}",
                restore: "{{ Forum::route('bulk.post.restore') }}"
            };
            const postActionMethods = {
                delete: 'DELETE',
                restore: 'POST',
            };

            const state = Vue.reactive({
                selectedPostAction: 'delete',
                selectedPosts: [],
                selectedThreadAction: null,
            });

            function toggleAll() {
                state.selectedPosts = (state.selectedPosts.length < selectablePosts.length) ? selectablePosts : [];
            }

            function submitThread(event) {
                if (threadActionMethods[state.selectedThreadAction] === 'DELETE' && !confirm("{{ trans('forum::general.generic_confirm') }}"))
                {
                    event.preventDefault();
                }
            }

            function submitPosts(event) {
                if (postActionMethods[state.selectedPostAction] === 'DELETE' && !confirm("{{ trans('forum::general.generic_confirm') }}")) {
                    event.preventDefault();
                }
            }

            return {
                posts,
                selectablePosts,
                postActions,
                postActionMethods,
                state,
                toggleAll,
                submitThread,
                submitPosts,
            };
        }
    }).mount('#thread');

    
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>

    <script>
        new ClipboardJS('.btnClipboardJS');

        window.onload = function currentURL() {
            const URL = window.location.href;
            document.getElementById('copy').innerHTML = '<a onClick="copiedToClipboard()" class="btn btn-outline-secondary btnClipboardJS" data-clipboard-text="' + URL + '" id="alertCard"><i class="bi bi-share" aria-hidden="true"></i> Share</a>'
        }

        function copiedToClipboard() { 
            document.getElementById('alertCard').innerHTML = '<i class="bi bi-check" aria-hidden="true"></i> URL Copied!';
            setTimeout(function(){document.getElementById('alertCard').innerHTML = '<i class="bi bi-share" aria-hidden="true"></i> Share';}, 1000);
        }
    </script>

    <script>
        function toggleContent(button) {
            const contentDiv = button.closest('.post-content');
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

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn.btn-link.p-0').forEach(function(btn) {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();
                });
            });
        });
    </script>
@stop
