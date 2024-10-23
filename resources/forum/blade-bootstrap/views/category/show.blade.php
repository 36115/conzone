{{-- $thread is passed as NULL to the master layout view to prevent it from showing in the breadcrumbs --}}
@extends('forum::layouts.main', ['thread' => null])

@section('content')
    <div class="d-flex flex-column">
        <div class="d-flex align-items-center">
            <h2 class="text-primary me-2">{{ $category->title }}</h2>

            @can ('editCategories')
                @can ('edit', $category)
                    <a class="hover text-body link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" data-open-modal="edit-category"><i class="bi bi-pencil-square"></i> {{ trans('forum::general.edit') }}</a>
                @endcan
            @endcan
        </div>

        @if ($category->description)
            <div class="card border p-3">
                <h6 class="pb-2 border-bottom">Description:</h6>
                <p class="text-muted fw-light">{!! nl2br(e($category->description)) !!}</p>
            </div>
            <hr>
        @endif
    </div>

    {{--  <div class="border-bottom mb-3">
        <h5 class="py-2 mb-3">Search Threads</h5>
        
        <form class="mb-3" method="POST" action="">
            <div class="input-group">
                <input class="form-control rounded-start-pill" type="search" placeholder="Type here to search!" aria-label="search" required>
                <button class="btn border border-body-emphasis rounded-end-pill" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div> --}}

    <div id="category">

        @if (!$category->children->isEmpty())
            @foreach ($category->children as $subcategory)
                <h2 class="text-primary me-2">{{ trans('forum::categories.subcategories') }}</h2>

                @include ('forum::category.partials.list', ['category' => $subcategory])
            @endforeach
            <hr>
        @endif

        @if ($category->accepts_threads)
            @if (!$threads->isEmpty())
                <div class="mt-4">
                    {{ $threads->links('forum::pagination') }}
                </div>

                @if (count($selectableThreadIds) > 0)
                    @can ('manageThreads', $category)
                        <form :action="actions[state.selectedAction]" method="POST">
                            @csrf
                            <input type="hidden" name="_method" :value="actionMethods[state.selectedAction]" />

                            <div class="d-flex justify-content-end mt-2">
                                <div class="form-check">
                                    <label for="selectAllThreads">
                                        {{ trans('forum::threads.select_all') }}
                                    </label>
                                    <input type="checkbox" value="" id="selectAllThreads" class="form-check-input" @click="toggleAll" :checked="state.selectedThreads.length == selectableThreadIds.length">
                                </div>
                            </div>
                    @endcan
                @endif

                <div class="threads list-group my-3 shadow-sm">
                    @foreach ($threads as $thread)
                        @include ('forum::thread.partials.list')
                    @endforeach
                </div>

                @if (count($selectableThreadIds) > 0)
                    @can ('manageThreads', $category)
                            <div class="position-fixed pb-xs-0 pr-xs-0 pb-sm-3 pr-sm-3 m-2" style="bottom: 0; right: 0; z-index: 1020;">
                                <transition name="fade">
                                    <div class="card bg-body-tertiary shadow-sm" v-if="state.selectedThreads.length">
                                        <div class="card-header text-center">
                                            {{ trans('forum::general.with_selection') }}
                                        </div>
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text border bg-body-secondary rounded-start-pill rounded-end-0" for="bulk-actions">{{ trans_choice('forum::general.actions', 1) }}</label>
                                                </div>
                                                <select class="form-select rounded-end-pill" id="bulk-actions" v-model="state.selectedAction">
                                                    @can ('deleteThreads', $category)
                                                        <option value="delete">{{ trans('forum::general.delete') }}</option>
                                                    @endcan
                                                    @can ('restoreThreads', $category)
                                                        <option value="restore">{{ trans('forum::general.restore') }}</option>
                                                    @endcan
                                                    @can ('moveThreadsFrom', $category)
                                                        <option value="move">{{ trans('forum::general.move') }}</option>
                                                    @endcan
                                                    @can ('lockThreads', $category)
                                                        <option value="lock">{{ trans('forum::threads.lock') }}</option>
                                                        <option value="unlock">{{ trans('forum::threads.unlock') }}</option>
                                                    @endcan
                                                    @can ('pinThreads', $category)
                                                        <option value="pin">{{ trans('forum::threads.pin') }}</option>
                                                        <option value="unpin">{{ trans('forum::threads.unpin') }}</option>
                                                    @endcan
                                                </select>
                                            </div>

                                            <div class="mb-3" v-if="state.selectedAction == 'move'">
                                                <label for="category-id">{{ trans_choice('forum::categories.category', 1) }}</label>
                                                <select name="category_id" id="category-id" class="form-select rounded-end-pill">
                                                    @include ('forum::category.partials.options', ['categories' => $threadDestinationCategories, 'hide' => $category])
                                                </select>
                                            </div>

                                            @if (config('forum.general.soft_deletes'))
                                                <div class="form-check mb-3" v-if="state.selectedAction == 'delete'">
                                                    <input class="form-check-input" type="checkbox" name="permadelete" value="1" id="permadelete">
                                                    <label class="form-check-label" for="permadelete">
                                                        {{ trans('forum::general.perma_delete') }}
                                                    </label>
                                                </div>
                                            @endif

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary rounded-pill" @click="submit" :disabled="state.selectedAction == null">{{ trans('forum::general.proceed') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </transition>
                            </div>
                        </form>
                    @endcan
                @endif
            @else
                <div class="card my-3">
                    <div class="card-body">
                        {{ trans('forum::threads.none_found') }}
                        @can ('createThreads', $category)
                            <br>
                            <a href="{{ Forum::route('thread.create', $category) }}">{{ trans('forum::threads.post_the_first') }}</a>
                        @endcan
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col col-xs-8">
                    {{ $threads->links('forum::pagination') }}
                </div>
            </div>
        @endif
    </div>

    {{-- @if (!$threads->isEmpty())
        @can ('markThreadsAsRead')
            <div class="text-center mt-3">
                <button class="btn btn-primary rounded-pill px-5" data-open-modal="mark-threads-as-read">
                    <i data-feather="book"></i> {{ trans('forum::general.mark_read') }}
                </button>
            </div>

            @include ('forum::category.modals.mark-threads-as-read')
        @endcan
    @endif --}}

    @can ('editCategories')
        @can ('edit', $category)
            @include ('forum::category.modals.edit')
        @endcan
    @endcan
    @can ('deleteCategories')
        @can ('delete', $category)
            @include ('forum::category.modals.delete')
        @endcan
    @endcan

    <style>
        .list-group.threads .list-group-item
        {
            border-left-width: 2px;
        }

        .list-group.threads .list-group-item.locked
        {
            border-left-color: var(--bs-yellow);
        }

        .list-group.threads .list-group-item.pinned
        {
            border-left-color: var(--bs-cyan);
        }

        .list-group.threads .list-group-item.deleted
        {
            border-left-color: var(--bs-red);
            opacity: 0.5;
        }
    </style>

    <script type="module">
    Vue.createApp({
        setup() {
            const selectableThreadIds = @json($selectableThreadIds);

            const actions = {
                delete: "{{ Forum::route('bulk.thread.delete') }}",
                restore: "{{ Forum::route('bulk.thread.restore') }}",
                lock: "{{ Forum::route('bulk.thread.lock') }}",
                unlock: "{{ Forum::route('bulk.thread.unlock') }}",
                pin: "{{ Forum::route('bulk.thread.pin') }}",
                unpin: "{{ Forum::route('bulk.thread.unpin') }}",
                move: "{{ Forum::route('bulk.thread.move') }}"
            };

            const actionMethods = {
                delete: 'DELETE',
                restore: 'POST',
                lock: 'POST',
                unlock: 'POST',
                pin: 'POST',
                unpin: 'POST',
                move: 'POST'
            };

            const state = Vue.reactive({
                selectedAction: null,
                selectedThreads: [],
                isEditModalOpen: false,
                isDeleteModalOpen: false
            });

            function toggleAll()
            {
                state.selectedThreads = (state.selectedThreads.length < selectableThreadIds.length) ? selectableThreadIds : [];
            }

            function submit(event)
            {
                if (actionMethods[state.selectedAction] === 'DELETE' && !confirm("{{ trans('forum::general.generic_confirm') }}"))
                {
                    event.preventDefault();
                }
            }

            function onClickModal(event)
            {
                if (event.target.classList.contains('modal'))
                {
                    state.isEditModalOpen = false;
                    state.isDeleteModalOpen = false;
                }
            }

            return {
                selectableThreadIds,
                actions,
                actionMethods,
                state,
                toggleAll,
                submit,
                onClickModal,
            };
        }
    }).mount('#category');
    </script>
@stop
