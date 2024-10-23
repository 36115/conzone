{{-- $category is passed as NULL to the master layout view to prevent it from showing in the breadcrumbs --}}
@extends ('forum::layouts.main', ['category' => null])
@section('page') Home @endsection
@section ('content')
    <h1 class="text text-center">{{ trans('forum::general.index') }}</h1>

    <h3 class="text h-3 my-3"><i class="bi bi-tags-fill"></i> All Topics</h3>
    @foreach ($categories as $category)
        @include ('forum::category.partials.list', ['titleClass' => 'lead'])
    @endforeach
@stop
