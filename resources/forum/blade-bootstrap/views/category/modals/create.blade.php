@component('forum::modal-form')
    @slot('key', 'create-category')
    @slot('title', trans('forum::categories.create'))
    @slot('route', Forum::route('category.store'))

    <div class="mb-3">
        <label for="title">{{ trans('forum::general.title') }}</label>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control border rounded-pill" placeholder="Enter topic name">
    </div>
    <div class="mb-3">
        <label for="description">{{ trans('forum::general.description') }}</label>
        <textarea name="description" class="form-control" rows="6" placeholder="Write topic content here" required>{{ old('description') }}</textarea>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input rounded-pill" type="checkbox" name="accepts_threads" id="accepts-threads" value="1" {{ old('accepts_threads') ? 'checked' : '' }}>
            <label class="form-check-label user-select-none" for="accepts-threads">{{ trans('forum::categories.enable_threads') }}</label>
        </div>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input rounded-pill" type="checkbox" name="is_private" id="is-private" value="1" {{ old('is_private') ? 'checked' : '' }}>
            <label class="form-check-label user-select-none" for="is-private">{{ trans('forum::categories.make_private') }}</label>
        </div>
    </div>

    @slot('actions')
        <button type="submit" class="btn btn-primary rounded-pill pull-right">{{ trans('forum::general.create') }}</button>
    @endslot
@endcomponent
