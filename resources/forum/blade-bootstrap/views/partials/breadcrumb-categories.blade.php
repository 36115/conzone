@if ($category->parent !== null)
    @include ('forum::partials.breadcrumb-categories', ['category' => $category->parent])
@endif
<li class="breadcrumb-item"><a class="link-underline link-underline-opacity-0" href="{{ Forum::route('category.show', $category) }}">{{ $category->title }}</a></li>
