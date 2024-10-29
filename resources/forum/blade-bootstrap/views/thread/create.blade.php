@extends ('forum::layouts.main', ['breadcrumbs_append' => [trans('forum::threads.new_thread')]])
@section('page') Create {{ trans('forum::threads.new_thread') }} ({{ $category->title }}) @endsection
@section ('content')
    <div id="create-thread">
        <h2 class="mb-4">Create {{ trans('forum::threads.new_thread') }} ({{ $category->title }})</h2>

        <form method="POST" action="{{ Forum::route('thread.store', $category) }}">
            @csrf

            <div class="mb-3">
                <label for="title">Topic Name</label> <span class="text-danger">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter your thread name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="content">Content</label> <span class="text-danger">*</span></label>
                <textarea name="content" class="form-control" rows="6" placeholder="Write your thread content here" required>{{ old('content') }}</textarea>
            </div>

            <div class="text-end">
                <a href="{{ URL::previous() }}" class="btn btn-link">{{ trans('forum::general.cancel') }}</a>
                <button type="submit" class="btn btn-primary rounded-pill px-5"><i class="bi bi-plus-lg"></i> {{ trans('forum::general.create') }}</button>
            </div>
        </form>
    </div>
@stop
