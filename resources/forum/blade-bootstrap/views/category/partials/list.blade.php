<div class="category list-group my-4">
    <div class="list-group-item p-4 shadow-sm rounded-4">
        <div class="row align-items-center">
            <div class="col-sm text-md-start">
                <h5 class="card-title mb-2">
                    <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ Forum::route('category.show', $category) }}">{{ $category->title }}</a>
                </h5>
                <p class="card-text text-muted fw-light">{!! nl2br(e($category->description)) !!}</p>
            </div>
            <div class="col-sm-2 text-md-end text-center">
                @if ($category->accepts_threads)
                    <span class="badge rounded-pill bg-primary mb-1">
                        {{ trans_choice('forum::threads.thread', 2) }}: {{ $category->thread_count }}
                    </span>
                    <br>
                    <span class="badge rounded-pill bg-primary">
                        {{ trans_choice('forum::posts.post', 2) }}: {{ $category->post_count }}
                    </span>
                @endif
            </div>
            <div class="col-sm text-md-end text-muted">
                @if ($category->accepts_threads)
                    @if ($category->newestThread)
                        <div>
                            <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ Forum::route('thread.show', $category->newestThread) }}">{{ $category->newestThread->title }} </a>
                            @include ('forum::partials.timestamp', ['carbon' => $category->newestThread->created_at])
                        </div>
                    @endif
                    @if ($category->latestActiveThread && $category->latestActiveThread->post_count > 1)
                        <div>
                            <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ Forum::route('thread.show', $category->latestActiveThread->lastPost) }}">Re: {{ $category->latestActiveThread->title }} </a>
                            @include ('forum::partials.timestamp', ['carbon' => $category->latestActiveThread->lastPost->created_at])
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    @if ($category->children->count() > 0)
        <div class="subcategories pt-2 d-flex align-items-center">
            @foreach ($category->children as $subcategory)
                <div class="display-4 mx-2 opacity-25">
                    <i class="bi bi-arrow-return-right"></i>
                </div>
                <div class="list-group-item rounded-4">
                    <div class="row align-items-center">
                        <div class="col-sm text-md-start">
                            <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ Forum::route('category.show', $subcategory) }}">{{ $subcategory->title }}</a>
                            <div class="text-muted fw-light mb-2">{{ $subcategory->description }}</div>
                        </div>
                        <div class="col-sm-2 text-md-end text-center">
                            <span class="badge rounded-pill bg-primary mb-1">
                                {{ trans_choice('forum::threads.thread', 2) }}: {{ $subcategory->thread_count }}
                            </span>
                            <br>
                            <span class="badge rounded-pill bg-primary">
                                {{ trans_choice('forum::posts.post', 2) }}: {{ $subcategory->post_count }}
                            </span>
                        </div>
                        <div class="col-sm text-md-end text-muted">
                            @if ($subcategory->newestThread)
                                <div>
                                    <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ Forum::route('thread.show', $subcategory->newestThread) }}">{{ $subcategory->newestThread->title }}</a>
                                    @include ('forum::partials.timestamp', ['carbon' => $subcategory->newestThread->created_at])
                                </div>
                            @endif
                            @if ($subcategory->latestActiveThread && $subcategory->latestActiveThread->post_count > 1)
                                <div>
                                    <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ Forum::route('thread.show', $subcategory->latestActiveThread->lastPost) }}">Re: {{ $subcategory->latestActiveThread->title }}</a>
                                    @include ('forum::partials.timestamp', ['carbon' => $subcategory->latestActiveThread->lastPost->created_at])
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
