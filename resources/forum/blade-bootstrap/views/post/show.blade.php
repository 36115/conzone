@extends ('forum::layouts.main', ['breadcrumbs_append' => [trans('forum::posts.view')]])
@section('page') {{ trans('forum::posts.view') }} ({{ $thread->title }}) @endsection
@section ('content')
    <div id="post">
        <div class="d-flex flex-row justify-content-between mb-3">
            <h2 class="flex-grow-1">{{ trans('forum::posts.view') }} ({{ $thread->title }})</h2>
        </div>

        <hr>

        @include ('forum::post.partials.list', ['post' => $post, 'single' => true])
    </div>
@stop
