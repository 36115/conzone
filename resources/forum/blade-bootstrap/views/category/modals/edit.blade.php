@component('forum::modal-form')
    @slot('key', 'edit-category')
    @slot('title', trans('forum::general.edit'))
    @slot('route', Forum::route('category.update', $category))
    @slot('method', 'PATCH')

    <div class="mb-3">
        <label for="title">{{ trans('forum::general.title') }}</label>
        <input type="text" name="title" value="{{ old('title') ?? $category->title }}" class="form-control" placeholder="Enter your thread name" required>
    </div>
    <div class="mb-3">
        <label for="description">{{ trans('forum::general.description') }}</label>
        <textarea name="description" class="form-control" rows="6" placeholder="Write your thread content here" required>{{ old('description') ?? $category->description }}</textarea>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input type="hidden" name="accepts_threads" value="0" />
            <input class="form-check-input" type="checkbox" name="accepts_threads" id="accepts-threads" value="1" {{ $category->accepts_threads ? 'checked' : '' }}>
            <label class="form-check-label" for="accepts-threads">{{ trans('forum::categories.enable_threads') }}</label>
        </div>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input type="hidden" name="is_private" value="0" />
            <input class="form-check-input" type="checkbox" name="is_private" id="is-private" value="1" {{ $category->is_private ? 'checked' : '' }} {{ $privateAncestor != null ? 'disabled' : '' }}>
            <label class="form-check-label" for="is-private">{{ trans('forum::categories.make_private') }}</label>
        </div>
    </div>
    @if ($privateAncestor != null)
        <div class="alert alert-primary" role="alert">
            {!!trans('forum::categories.access_controlled_by_private_ancestor', ['category' => "<a href=\"{$privateAncestor->route}\">{$privateAncestor->title}</a>"]) !!}
        </div>
    @endif

    @slot('actions')
        <button type="submit" class="btn btn-primary rounded-pill pull-right">{{ trans('forum::general.save') }}</button>
    @endslot
@endcomponent
